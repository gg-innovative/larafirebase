<p align="center"><img src="/art/cover.png" height="400"></p>

<p align="center">
    <a href="https://packagist.org/packages/gg-innovative/larafirebase">
        <img src="https://img.shields.io/packagist/dt/gg-innovative/larafirebase" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/gg-innovative/larafirebase">
        <img src="https://img.shields.io/packagist/v/gg-innovative/larafirebase" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/gg-innovative/larafirebase">
        <img src="https://img.shields.io/packagist/l/gg-innovative/larafirebase" alt="License">
    </a>
</p>


### Introduction

**Larafirebase** is a package thats offers you to send push notifications via Firebase in Laravel.

Firebase Cloud Messaging (FCM) is a cross-platform messaging solution that lets you reliably deliver messages at no cost.

For use cases such as instant messaging, a message can transfer a payload of up to 4KB to a client app.

### Installation

Follow the steps below to install the package.


**Composer**

```
composer require gg-innovative/larafirebase
```

**Copy Config**

Run `php artisan vendor:publish --provider="GGInnovative\Larafirebase\Providers\LarafirebaseServiceProvider"` to publish the `larafirebase.php` config file.

**Get Athentication Key**

Get Authentication Key from https://console.firebase.google.com/

**Configure larafirebase.php as needed**

```
'authentication_key' => '{AUTHENTICATION_KEY}'
```

### Usage

Follow the steps below to find how to use the package.

Example usage in **Controller/Service** or any class:

```php
use GGInnovative\Larafirebase\Facades\Larafirebase;

class MyController
{
    public function sendNotification()
    {
        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->withImage('https://firebase.google.com/images/social.png')
            ->withAdditionalData([
                'name' => 'wrench',
                'mass' => '1.3kg',
                'count' => '3'
            ])
            ->withToken('TOKEN_HERE')
            ->sendNotification();
        
        // Or
        return Larafirebase::fromRaw([
            // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages
            "name" => "string",
            "data" => [
                "string" => "string",
            ],
            "notification" => [
                "object" => "(Notification)"
            ],
            "android" => [
                "object" => "(AndroidConfig)"
            ],
            "webpush" => [
                "object" => "(WebpushConfig)",
            ],
            "apns" => [
                "object" => "(ApnsConfig)"
            ],
            "fcm_options" => [
                "object" => "(FcmOptions)"
            ],
            "token" => "string",
            "topic" => "string",
            "condition" => "string"
        ])->sendNotification();
    }
}
```

Example usage in **Notification** class:

```php
use Illuminate\Notifications\Notification;
use GGInnovative\Larafirebase\Messages\FirebaseMessage;

class SendBirthdayReminder extends Notification
{
    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    /**
     * Get the firebase representation of the notification.
     */
    public function toFirebase($notifiable)
    {
        return (new FirebaseMessage)
            ->withTitle('Hey, ', $notifiable->first_name)
            ->withBody('Happy Birthday!')
            ->withToken('TOKEN_HERE')
            ->asNotification();
    }
}
```

### Tips

- You can use `larafirebase()` helper instead of Facade.
