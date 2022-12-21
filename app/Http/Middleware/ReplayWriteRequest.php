<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;

class ReplayWriteRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Complete Request First
        $response = $next($request);
        
        // Get replay to region and the state bag
        $replayTo    = $this->getReplayTo();
        $stateBagStr = $this->getStateBag( $request );

        // Allow replay if replay to is not yet in state bag
        if( $this->allowReplayTo( $replayTo, $stateBagStr ) ){
           
            // Append currentRegion to stateBag
            $stateBagStr .= env('FLY_REGION').'_';
            Log::info( 'updated state bag is '. $stateBagStr);

            $replay = 'region='.$replayTo.';state='.$stateBagStr;
            Log::info( 'replay bag is now'. $replay);

            // Replay to next region with flag for current region in state bag
            $response->withHeaders([
                'fly-replay'=>$replay,
                'cur-region'=> env('FLY_REGION')
            ]);
        }
       
        return $response;
    }

    /**
     * Decide whether to allow replay to a region based on existence in $stateBagStr: exists = false; else true.
     * 
     * @param string $replayTo - region our current region always replays request to  
     * @param string $stateBagStr - state passed from one instance to another, containing region identifiers of instances the current request has already been processed in
     * 
     * @return bool
     */
    function allowReplayTo( string $replayTo, $stateBagStr ) : bool
    {
        if(strpos($stateBagStr,$replayTo)===false){
            Log::info('Allowing Replay to region '.$replayTo.', since its not yet in state bag '.$stateBagStr );
            return true;
        }else{
            Log::info('Stopping Replay to region '.$replayTo.' since its already in state bag '.$stateBagStr );
            return false;
        }
    }

    /**
     * Retrieves the region to replay request to based on current region. Each region has a hardcoded "sibling" region it always replays to.
     * 
     * @return string
     */
    function getReplayTo() : string
    {
        // Reapply to map
        $replayToList = [
            'ams' => 'fra',
            'fra' => 'yul',
            'yul' => 'ams'
        ];

        // Get the current region's replay to region
        $currentRegion = env('FLY_REGION');
        Log::info('CurrentRegion is '.$currentRegion);
        
        // Return replay region
        $replayTo = $replayToList[$currentRegion];
        Log::info( 'From '.$currentRegion.', Replay To is:'.$replayTo );
        return $replayTo;
    }

    /**
     * Gets content of state passed in fly-replay-src header.
     * 
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    function getStateBag( Request $request ) : string
    {
        if ($request->hasHeader('fly-replay-src')) {
            Log::info( 'fly-replay-src headers: '.json_encode( $request->header('fly-replay-src') ) );
            $stateBagSeparationList = explode( 'state=', $request->header('fly-replay-src') ) ; 
            if( count($stateBagSeparationList)>1 ){
                Log::info( 'prev state bag is '.$stateBagSeparationList[1]);
                return $stateBagSeparationList[1];
            }
        }
        return '';
    }

}
