<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Filament\Client\Pages\Verification;
class CheckVerificationStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        // Проверяем, что пользователь аутентифицирован и не является админом
        if ($user && !$user->is_admin) {
            $isApproved = $user->verification_status === 'approved';
            $isVerificationRoute = $request->routeIs('filament.client.pages.verification');
            // Если статус НЕ 'approved' и мы НЕ на странице верификации, перенаправляем на нее
            if (!$isApproved && !$isVerificationRoute) {
                return redirect()->route('filament.client.pages.verification');
            }
            // Если статус 'approved' и мы пытаемся зайти на страницу верификации, перенаправляем в дашборд
            if ($isApproved && $isVerificationRoute) {
                return redirect()->route('filament.client.pages.dashboard');
            }
        }
        return $next($request);
    }
}
