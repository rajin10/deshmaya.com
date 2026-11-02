@extends('layouts.app')
@section('title', 'Request a Quote')
@section('content')
<section class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="text-center">
        <h1 class="font-heading text-4xl text-primary-dark" data-reveal>Request a Quote</h1>
        <p class="mt-3 text-muted" data-reveal style="--reveal-delay:120ms">Tell us what you need and our export team will prepare a quote.</p>
    </div>

    <div class="mt-10 rounded-xl border border-line bg-white p-6 shadow-sm sm:p-8">
        @if (session('status'))
            <p role="status" class="mb-6 rounded-md border border-green-200 bg-green-50 p-4 text-green-800">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div role="alert" class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-red-800">
                Please review the highlighted fields and try again.
            </div>
        @endif

        <form method="POST" action="{{ route('request-quote.submit') }}" class="space-y-5">
            @csrf
            <div class="absolute -left-[10000px]" aria-hidden="true">
                <label for="quote-website">Leave this field empty</label>
                <input id="quote-website" type="text" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label for="quote-name" class="mb-1 block text-sm font-medium text-ink">Name</label>
                <input id="quote-name" name="name" value="{{ old('name') }}" required maxlength="120" autocomplete="name" class="w-full rounded-md border border-line px-3 py-2 text-ink">
                @error('name')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="quote-company" class="mb-1 block text-sm font-medium text-ink">Company <span class="text-muted">(optional)</span></label>
                <input id="quote-company" name="company" value="{{ old('company') }}" maxlength="180" autocomplete="organization" class="w-full rounded-md border border-line px-3 py-2 text-ink">
                @error('company')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="quote-email" class="mb-1 block text-sm font-medium text-ink">Email</label>
                <input id="quote-email" type="email" name="email" value="{{ old('email') }}" required maxlength="254" autocomplete="email" class="w-full rounded-md border border-line px-3 py-2 text-ink">
                @error('email')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="quote-phone" class="mb-1 block text-sm font-medium text-ink">Phone <span class="text-muted">(optional)</span></label>
                <input id="quote-phone" type="tel" name="phone" value="{{ old('phone') }}" maxlength="50" autocomplete="tel" class="w-full rounded-md border border-line px-3 py-2 text-ink">
                @error('phone')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="quote-country" class="mb-1 block text-sm font-medium text-ink">Country</label>
                <input id="quote-country" name="country" value="{{ old('country') }}" required maxlength="100" autocomplete="country-name" class="w-full rounded-md border border-line px-3 py-2 text-ink">
                @error('country')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="quote-product" class="mb-1 block text-sm font-medium text-ink">Product <span class="text-muted">(optional)</span></label>
                <select id="quote-product" name="product_id" class="w-full rounded-md border border-line px-3 py-2 text-ink">
                    <option value="">Select a product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @selected((string) old('product_id', $selectedProductId) === (string) $product->id)>{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_id')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="quote-quantity" class="mb-1 block text-sm font-medium text-ink">Quantity</label>
                    <input id="quote-quantity" type="number" name="quantity" value="{{ old('quantity') }}" min="0.001" step="0.001" required class="w-full rounded-md border border-line px-3 py-2 text-ink">
                    @error('quantity')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="quote-unit" class="mb-1 block text-sm font-medium text-ink">Unit</label>
                    <select id="quote-unit" name="unit" required class="w-full rounded-md border border-line px-3 py-2 text-ink">
                        @foreach (['kg' => 'Kilograms', 'tonnes' => 'Tonnes', 'cartons' => 'Cartons', 'containers' => 'Containers'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('unit', 'kg') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('unit')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label for="quote-message" class="mb-1 block text-sm font-medium text-ink">Additional details <span class="text-muted">(optional)</span></label>
                <textarea id="quote-message" name="message" rows="5" maxlength="5000" class="w-full rounded-md border border-line px-3 py-2 text-ink">{{ old('message') }}</textarea>
                @error('message')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
            </div>

            @if ($turnstileSiteKey)
                <div>
                    <div class="cf-turnstile" data-sitekey="{{ $turnstileSiteKey }}"></div>
                    @error('cf-turnstile-response')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
            @elseif (app()->isProduction())
                <p role="alert" class="text-sm text-red-700">Online form security is not configured. Please contact us using the details in the footer.</p>
            @endif

            <button type="submit" class="rounded-md bg-primary px-5 py-3 font-medium text-white transition hover:bg-primary-dark">Send quote request</button>
        </form>
    </div>
</section>
@endsection

@if ($turnstileSiteKey)
    @push('head')
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endpush
@endif
