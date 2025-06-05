<?php namespace Ofthewildfire\Securitymonitor;

use System\Classes\PluginBase;
use Backend\Models\User as UserModel;
use Mail;
use Log;

/**
 * Security Monitor Plugin
 * Monitors suspicious password reset attempts and alerts users with IP tracking
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'ofthewildfire.securitymonitor::lang.plugin.name',
            'description' => 'ofthewildfire.securitymonitor::lang.plugin.description',
            'author' => 'Ofthewildfire',
            'icon' => 'oc-icon-shield',
            'homepage' => 'https://github.com/ofthewildfire/octobercms-security-monitor'
        ];
    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot()
    {
        // Extend the Backend User model to monitor password resets
        UserModel::extend(function($model) {
            $model->bindEvent('model.afterSave', function() use ($model) {
                // Check if reset_password_code was just set (password reset requested)
                if ($model->isDirty('reset_password_code') && $model->reset_password_code) {
                    $this->handlePasswordResetRequest($model);
                }
            });
        });
    }

    /**
     * Handle password reset request - capture IP and send security notification
     */
    protected function handlePasswordResetRequest($user)
    {
        $ip = request()->ip();
        $userAgent = request()->header('User-Agent');
        
        // Log the security event
        Log::info("Security Monitor: Password reset requested for user '{$user->login}' from IP: {$ip}");
        
        // Send security notification email
        try {
            Mail::send('ofthewildfire.securitymonitor::mail.reset_notification', [
                'user' => $user,
                'ip' => $ip,
                'userAgent' => $userAgent,
                'timestamp' => now(),
                'code' => $user->reset_password_code
            ], function($message) use ($user) {
                $message->to($user->email, $user->full_name);
                $message->subject('Security Alert: Password Reset Request');
            });
        } catch (\Exception $e) {
            Log::error("Security Monitor: Failed to send notification email: " . $e->getMessage());
        }
    }

    /**
     * Register plugin components
     */
    public function registerComponents()
    {
        return [];
    }

    /**
     * Register plugin permissions
     */
    public function registerPermissions()
    {
        return [
            'ofthewildfire.securitymonitor.access_settings' => [
                'tab' => 'ofthewildfire.securitymonitor::lang.plugin.name',
                'label' => 'ofthewildfire.securitymonitor::lang.permissions.access_settings'
            ],
        ];
    }
}