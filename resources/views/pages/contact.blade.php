<x-layouts.app>

    <x-slot:title>
        {{ __('contact.contact_title') }}
    </x-slot:title>

    <div class="container">
        <p>{{ __('contact.contact_info') }}</p>

        <form action="/contact" method="POST">
            @csrf
            <div>
                <label for="name">{{ __('contact.your_name') }}</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div>
                <label for="email">{{ __('contact.your_email') }}</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div>
                <label for="subject">{{ __('contact.subject') }}</label>
                <input type="text" name="subject" id="subject" required>
            </div>

            <div>
                <label for="message">{{ __('contact.message') }}</label>
                <textarea name="message" id="message" rows="4" required></textarea>
            </div>

            <button type="submit">{{ __('contact.send_message') }}</button>
        </form>

    </div>

</x-layouts.app>
