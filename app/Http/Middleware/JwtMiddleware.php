<?php

// namespace App\Http\Middleware;

// use Closure;
// use Tymon\JWTAuth\Facades\JWTAuth;
// use Tymon\JWTAuth\Exceptions\JWTException;

// class JwtMiddleware
// {
//     public function handle($request, Closure $next)
//     {
//         try {
//             $user = JWTAuth::parseToken()->authenticate();
//         } catch (JWTException $e) {
//             return response()->json(['error' => 'Token not valid'], 401);
//         }

//         return $next($request);
//     }
// }

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException; // Impor pengecualian spesifik
use Tymon\JWTAuth\Exceptions\TokenInvalidException; // Impor pengecualian spesifik
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException; // Impor pengecualian spesifik
use Tymon\JWTAuth\Exceptions\JWTException; // Tetap impor untuk pengecualian umum lainnya

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            // Mencoba mem-parse token dari request dan mengautentikasi user
            $user = JWTAuth::parseToken()->authenticate();

            // Jika user tidak ditemukan (meskipun token valid), ini bisa jadi masalah data
            if (!$user) {
                return response()->json(['error' => 'User not found for this token'], 404);
            }

        } catch (TokenExpiredException $e) {
            // Token sudah kadaluarsa
            return response()->json(['error' => 'Token Expired'], 401);
        } catch (TokenInvalidException $e) {
            // Token tidak valid (misalnya, signature salah, format rusak)
            return response()->json(['error' => 'Token Invalid'], 401);
        } catch (TokenBlacklistedException $e) {
            // Token sudah di-blacklist (misalnya, setelah logout)
            return response()->json(['error' => 'Token Blacklisted'], 401);
        } catch (JWTException $e) {
            // Menangkap pengecualian JWT lainnya yang tidak spesifik di atas
            return response()->json(['error' => 'Could not authenticate token: ' . $e->getMessage()], 401);
        } catch (\Exception $e) {
            // Menangkap pengecualian PHP umum lainnya (misal: masalah koneksi DB)
            return response()->json(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }

        // Jika autentikasi berhasil, lanjutkan request
        return $next($request);
    }
}