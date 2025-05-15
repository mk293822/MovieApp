<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\MovieDetail|null $details
 * @method static \Database\Factories\MovieFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $raters
 * @property-read int|null $raters_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usersWhoSaved
 * @property-read int|null $users_who_saved_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $usersWhoWatched
 * @property-read int|null $users_who_watched_count
 */
	class Movie extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Movie|null $movie
 * @method static \Database\Factories\MovieDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MovieDetail query()
 * @mixin \Eloquent
 * @property \App\Enums\MovieGenreEnums $genre
 * @property mixed $language
 */
	class MovieDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserDetails|null $details
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movie> $ratedMovies
 * @property-read int|null $rated_movies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movie> $savedMovies
 * @property-read int|null $saved_movies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movie> $watchedMovies
 * @property-read int|null $watched_movies_count
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $liked_movies
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserDetailsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereLikedMovies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails whereUserId($value)
 * @mixin \Eloquent
 * @property \App\Enums\RoleEnums $role
 */
	class UserDetails extends \Eloquent {}
}

