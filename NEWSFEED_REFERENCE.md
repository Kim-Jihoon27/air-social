SIMPLE NEWSFEED - CODE REFERENCE
================================

1. MODEL (app/Models/AirSocial.php)
------------------------------------
- Eloquent model for database table
- $fillable = columns that can be mass-assigned
- Relationship: belongsTo(User::class)

2. CONTROLLER (app/Http/Controllers/AirSocialController.php)
--------------------------------------------------------------
- index() - Fetch posts from database
- AirSocial::with('user')->latest()->get()
- with('user') = eager loading (prevent N+1 query)
- latest() = order by created_at DESC

3. ROUTE (routes/web.php)
-------------------------
- Route::get('/', [AirSocialController::class, 'index']);
- Connects URL to controller method

4. VIEW (resources/views/newsfeed.blade.php)
---------------------------------------------
- Loop through posts: @forelse($air_post as $post)
- Use component: <x-post :post="$post" />
- :post = property binding (passes PHP variable)
- Empty state: @empty

5. COMPONENT (resources/views/components/post.blade.php)
-------------------------------------------------------
- @props(['post']) = accepts post as prop
- Display user name: {{ $post->user->name }}
- Display message: {{ $post->message }}
- Display time: {{ $post->created_at->diffForHumans() }}

6. CREATE POST (store method in controller)
-------------------------------------------
- $request->validate(['message' => 'required|string|max:255'])
- AirSocial::create(['message' => $message])
- redirect('/') - go back to home