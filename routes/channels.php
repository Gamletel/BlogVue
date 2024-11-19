<?php

use Illuminate\Support\Facades\Broadcast;

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});

Broadcast::channel('user.notification.{userID}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});