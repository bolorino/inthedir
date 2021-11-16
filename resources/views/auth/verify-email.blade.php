<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            <p>
                {{ __('Gracias por registrarte. Te hemos enviado un mensaje a tu dirección de correo electrónico para verificar tu dirección.') }}
            </p>
            <p>
                {{ __('Para confirmar tu dirección debes pulsar en el enlace de confirmación que aparece en ese mensaje.') }}
            </p>
            <p>
                {{ __('Si no has recibido el mensaje en unos minutos, por favor mira en tu carpeta de spam.') }}<br>
                {{ __('Si el mensaje tampoco está allí, pulsa sobre "Reenviar mensaje de verificación" para que volvamos a enviarlo.') }}
            </p>

        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Hemos enviado un nuevo enlace de verificación a la dirección de correo que proporcionaste durante el registro.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Reenviar mensaje de verificación') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Salir') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
