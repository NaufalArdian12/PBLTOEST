<x-mail::message>

    {{-- Logo --}}
    <div style="text-align: center; margin-bottom: 40px;">
        <img src="{{ asset('images/Logo.png') }}" alt="{{ config('app.name') }}"
            style="max-width: 180px; height: auto;">
    </div>

    {{-- Hero Section --}}
    <div style="text-align: center; margin-bottom: 40px;">
        <div
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; width: 80px; height: 80px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
            <span style="font-size: 40px;">✉️</span>
        </div>
        <h1 style="color: #2d3748; font-size: 32px; font-weight: 700; margin: 0 0 10px 0; line-height: 1.2;">
            Verify Your Email
        </h1>
        <p style="color: #718096; font-size: 18px; margin: 0; line-height: 1.5;">
            You're almost ready to get started!
        </p>
    </div>

    {{-- Welcome Message --}}
    <div
        style="background: #f7fafc; border-radius: 12px; padding: 30px; margin-bottom: 30px; border-left: 4px solid #667eea;">
        <p style="color: #2d3748; font-size: 16px; line-height: 1.6; margin: 0 0 15px 0;">
            Hello there! 👋
        </p>
        <p style="color: #4a5568; font-size: 16px; line-height: 1.6; margin: 0;">
            Thank you for joining <strong style="color: #667eea;">{{ config('app.name') }}</strong>. We're excited to
            have you on board!
        </p>
    </div>

    {{-- Call to Action --}}
    <div style="text-align: center; margin: 40px 0;">
        <p style="color: #4a5568; font-size: 16px; margin-bottom: 25px; line-height: 1.5;">
            To activate your account and start exploring, please verify your email address:
        </p>

        <x-mail::button :url="$url"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50px; padding: 15px 40px; font-weight: 600; font-size: 16px; text-decoration: none; display: inline-block; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); transition: all 0.3s ease;"
            target="_self">
            🚀 Verify My Email
        </x-mail::button>
    </div>

    {{-- Features Preview --}}
    <div
        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; padding: 25px; margin: 30px 0; text-align: center;">
        <h3 style="color: white; font-size: 20px; margin: 0 0 15px 0; font-weight: 600;">
            🎉 What's waiting for you?
        </h3>
        <p style="color: rgba(255,255,255,0.9); font-size: 14px; margin: 0; line-height: 1.5;">
            Amazing features, seamless experience, and a community ready to welcome you!
        </p>
    </div>

    {{-- Security Notice --}}
    <div style="background: #fed7d7; border: 1px solid #feb2b2; border-radius: 8px; padding: 20px; margin: 30px 0;">
        <div style="display: flex; align-items: flex-start;">
            <span style="font-size: 20px; margin-right: 10px;">🔒</span>
            <div>
                <h4 style="color: #c53030; font-size: 16px; margin: 0 0 8px 0; font-weight: 600;">
                    Security Notice
                </h4>
                <p style="color: #742a2a; font-size: 14px; margin: 0; line-height: 1.5;">
                    If you receive suspicious emails asking for account information, <strong>do not click any
                        links</strong>. Report them immediately to our security team.
                </p>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div style="text-align: center; margin-top: 40px; padding-top: 30px; border-top: 1px solid #e2e8f0;">
        <p style="color: #718096; font-size: 14px; margin: 0 0 10px 0;">
            Need help? We're here for you 24/7
        </p>
        <p style="color: #4a5568; font-size: 16px; margin: 0; font-weight: 500;">
            With love,<br>
            <span
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;">
                The {{ config('app.name') }} Team
            </span> ✨
        </p>
    </div>

    <x-slot:subcopy>
        <div style="background: #f7fafc; border-radius: 8px; padding: 20px; margin-top: 20px;">
            <p style="color: #718096; font-size: 13px; margin: 0 0 10px 0;">
                Having trouble with the button? Copy and paste this link into your browser:
            </p>
            <p
                style="background: white; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px; word-break: break-all; font-family: 'Courier New', monospace; font-size: 12px; color: #4a5568; margin: 0;">
                {{ $url }}
            </p>
        </div>
    </x-slot:subcopy>

</x-mail::message>
