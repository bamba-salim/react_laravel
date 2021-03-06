<?php

    namespace App\Http\Middleware;

    use App\Models\User;
    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class React
    {
        private $str;

        /**
         * Handle an incoming request.
         *
         * @param Request $request
         * @param \Closure $next
         * @return mixed
         */
        public function handle(Request $request, Closure $next)
        {
            $token = $request->header('token');

            if (!$token) return response()->json(['message' => 'Missing Token'], 403);

            $user = User::where('api_token', $token)->first();

            if (!$user) return response()->json(['message' => 'Invalid User'], 403);

            Auth::login($user);

            return $next($request);
        }
    }
