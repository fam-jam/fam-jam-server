# Knot Server

![](https://github.com/knotworks/knot-server/workflows/run-tests/badge.svg?branch=master)

A self-hosted social network for families and other small groups.

## Background

My Family and I used an app called [Path](https://path.com) to share private photos and moments for a number of years. It served us well, but unfortunately went the way of the dinosaur unexpectedly. I wanted to build something similar as a contingency plan, and Knot was the result. This repository represents the server-side component that one would self-host to act as the API for their private network, and it's up to you to design and write a client that interfaces with it. If you would like an opinionated starting point for a client application, feel free to check out the [sample client](https://github.com/knotworks/knot-client). Many of the currently supported features exist to mimic much of the functionality of Path, and that's generally the _Path_ (hehe) I'll take. As this project is fully open source, you are more than welcome to add, remove or modify any functionality you wish.

Thanks for checking out Knot!

## Features

### Secure cross-site cookie authentication

Knot's authentication system is powered by [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum). Users sign in with a simple email and password, and the server will send back a cookie to authorize all subsequent requests.

### Photo and video posts

Attach up to 5 photos or videos to a single post.

### Post meta attachments

- Tag friends in your posts
- Add a location to your posts

### Simple profile management

- Supports first name, last name, email, password, and avatar.
- Cover image support coming soon.

### Post comments

Optionally attach the commenter's location to the comment as well.

### Post Reactions

Simple, customizable reactions to a post without the need to comment.

### Friendship Management

- Send and receieve friend requests
- Accept or deny friend requests
- Remove existing friends

### Simple and customizable feed

A ready-to-go (and easily changeable) feed of posts from the authenticated user and their friends.

### Notifications

Receieve notifications when:

- You're added as a friend
- Someone accepts your friend request
- Someone comments on your post
- Someone replies to a comment thread you are a part of
- Someone adds a reaction to one of your posts

All notifications are currently stored in the database, but can be easily updated to go through other channels such as Slack as well.

### Cloud Upload Support

Knot supports [Cloudinary](https://cloudinary.com/) secure signature generation for all media uploads. Cloudinary has a generous free tier, and a really powerful suite of media management and manipulation tools. Check them out!

## Installation

Coming soon...
