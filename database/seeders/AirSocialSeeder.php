<?php

namespace Database\Seeders;

use App\Models\AirSocial;
use App\Models\User;
use Illuminate\Database\Seeder;

class AirSocialSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->command->error('No users found. Please seed users first!');
            return;
        }

        $messages = [
            "Air Social is such a great platform! Love the clean design 💙",
            "Just joined Air Social and I'm already impressed!",
            "Air Social is exactly what I've been looking for. Simple and effective!",
            "Loving the vibes on Air Social. Great community! 🌟",
            "Air Social makes it so easy to connect with others!",
            "This platform is amazing! Keep up the great work Air Social team 🚀",
            "Finally, a social platform that gets it right. Air Social for the win!",
            "Air Social's interface is so clean and intuitive!",
            "Been using Air Social for a week now and I'm hooked!",
            "Air Social is refreshing to use after all the clutter on other platforms",
            "Great job on Air Social! Can't wait to see what's next 👏",
            "Air Social is quickly becoming my favorite social platform!",
            "Love how straightforward and user-friendly Air Social is!",
            "Shoutout to Air Social for creating such a positive space! 💚",
            "Air Social is proof that simplicity wins! Love it!",
        ];

        for ($i = 0; $i < 20; $i++) {
            AirSocial::create([
                'user_id' => $users->random()->id,
                'message' => $messages[array_rand($messages)],
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}