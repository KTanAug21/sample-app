## Hello, what is this?
This is a repository containing the codebase for different applications I use for writing articles, or testing out things really.


## Deployed through Fly.io!
[Livewire](https://laravel-livewire.com/) apps--any apps really--are faster close to your users. 

Deploy your Laravel-Livewire app in a jiffy with [Fly.io](https://fly.io/docs/laravel/), wherever your users may be!

I finally deployed mine close to me in my own little space. 

Visit https://blue-sun-6217.fly.dev/, up in [Fly.io](https://fly.io/) :heartbeat:


## Set up
1. Clone the repository `git clone git@github.com:KTanAug21/sample-app.git`
2. Get our vendor packages, run `composer update`
3. Follow the Tailwind setup [here](https://tailwindcss.com/docs/guides/laravel) and Run `npm run dev`

## Deploying through Fly.io
1. Follow the deployment instructions [here](https://fly.io/docs/laravel/).
2. This repo is configured with Github CI Actions for auto deployment! So any git push to the repo sends an automatic re-deployment of my Fly App! Read how to quickly [set up here](https://fly.io/docs/laravel/the-basics/github-actions/).
3. You might run into "Mix manifest not found" error. If so, make sure to remove any mix('...') found in your application. In this repository's case, the `resources/views/welcome.blade.php` came with a `<link href="{{ mix('/css/app.css') }}" rel="stylesheet">` I had to remove.

## Constitution
1. This is a [Laravel](https://laravel.com/) project :)
2. Makes use of [Livewire](https://laravel-livewire.com/docs/2.x/quickstart#install-livewire)
3. And [Tailwind](https://tailwindcss.com/docs/guides/laravel), hence the `npm run dev` above
4. Flown with [Fly.io](https://fly.io/)

## Talk To Me
This page is found in https://blue-sun-6217.fly.dev/talk-to-me-page. 

It is a simple chat bot page where users can send messages to the server and receive a response per message. The server tries to find keywords from the message sent, and randomly sends back from a list of messages that are allocated for the keyword. If it's not no appropriate keyword is found the server picks a message randomly from a default list of messages.

Relevant files:
1. app/Http/Livewire/TalkToMe.php
2. app/Models/Chatbot.php
3. resources/views/livewire/talk-to-me.blade.php
4. resources/views/talk-to-me/index.blade.php