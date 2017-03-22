<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Follower;
use App\User;
use App\Howl;

/**
 * Create test data for development.
 *
 * Class dbFaker
 * @package App\Console\Commands
 */
class dbFaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:faker {--num=50}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add fake data
    {--num= : Number of rounds.}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * Force local debug environment.
         */
        if((!env('APP_DEBUG', false)) || (env('APP_ENV', "production") != "local"))
        {
            dd("DO NOT RUN IN PRODUCTION, EVER!");
        }

        // Create a faker object.
        $faker = \Faker\Factory::create();
        // Get positive base number. larger that 4.
        $num = $this->option('num');
        if( (!is_integer($num)) || ($num <= 3)) {
            $num = 4;
        }
        $errors = [];
        $x = 0;

        /*
         * Create users.
         */
        echo "\nUsers: ";
        for($i = 0; $i < $num; $i++)
        {
            try {
                User::create(
                    [
                        /*
                         * Set fake data and cut any text that is to long.
                         */
                        'name' => mb_substr($faker->name, 0, 30),
                        'username' => mb_substr($faker->unique()->userName, 0, 20),
                        'profile' => mb_substr($faker->jobTitle, 0, 200),
                        'location' => mb_substr($faker->city, 0, 255),
                        'email' => $faker->unique()->safeEmail,
                        'password' => bcrypt(str_random(10)),
                    ]
                );
            }catch (\Exception $e) {
                $errors[] = [$e->getMessage(), $e->getTraceAsString()];
            }
            $x++;
        }
        echo $x;


        /*
         * Create Howls that have a 50/50 chance of "at" mentioning another user.
         */
        $x =0;
        echo "\nHowls: ";
        $users = User::inRandomOrder()->Get(); // Get all user in random order.
        foreach ($users as $user) {
            $howls = $num * rand(0, 10); // Random number off howls.
            for ($i=0; $i < $howls; $i++) {
                $howl = implode(" ", $faker->words(rand(0, 9))); // Random lipsum words 0 to 9
                if (rand(0, 1)) {
                    $howl .= " @" . trim(User::All()->random(1)->first()->username) . " "; // "at" mentioning another user.
                }
                $howl .= implode(" ", $faker->words(rand(1, 40))); // Random lipsum words 1 to 160. (No empty Howls)
                try {
                    $h = mb_substr($howl, 0, 160); // Cut to size.
                    Howl::postHowl($user->id, ['howl' => $h]); // Persist howl.
                    $x++;
                }catch (\Exception $e)
                {
                    $errors[] = [$e->getMessage(), $e->getTraceAsString()];
                }
            }
        }
        echo $x; $x =0;


        /**
         * Randomly create follow/following relationships.
         */
        echo "\nRelationships: ";
        $users = User::inRandomOrder()->Get(); // Users in random order.
        foreach ($users as $user) {
            $followers = rand(0, ($num - 1)); // Follow none or all minus one.
            if($followers) {
                $newFollowers = User::All()->random($followers);
                foreach ($newFollowers as $follow) {
                    try{
                        Follower::toggle($user->id, $follow->id);
                        $x++;
                    }catch (\Exception $e)
                    {
                        $errors[] = [$e->getMessage(), $e->getTraceAsString()];
                    }
                }
            }
        }
        echo $x . "\nErrors: ";
        dump($errors);
    }
}

