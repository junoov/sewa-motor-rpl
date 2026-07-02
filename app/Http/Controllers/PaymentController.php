<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PaymentController extends Controller
{
    private function getPaymentMethods(): array
    {
        return [
            'bca' => [
                'name' => 'BCA',
                'type' => 'transfer',
                'account_number' => '1234 5678 90',
                'account_name' => 'PT MotoRent Indonesia',
                'steps' => [
                    'Buka aplikasi/mobile banking BCA.',
                    'Pilih menu Transfer ke Rekening BCA.',
                    'Masukkan nomor rekening 1234 5678 90.',
                    'Masukkan nominal transfer sesuai total.',
                    'Konfirmasi transfer dan simpan bukti.',
                ],
            ],
            'bri' => [
                'name' => 'BRI',
                'type' => 'transfer',
                'account_number' => '0987 6543 21',
                'account_name' => 'PT MotoRent Indonesia',
                'steps' => [
                    'Buka aplikasi BRIMO atau Internet Banking BRI.',
                    'Pilih menu Transfer ke BRI.',
                    'Masukkan nomor rekening 0987 6543 21.',
                    'Masukkan nominal transfer sesuai total.',
                    'Konfirmasi transfer dan simpan bukti.',
                ],
            ],
            'mandiri' => [
                'name' => 'Mandiri',
                'type' => 'transfer',
                'account_number' => '1122 3344 55',
                'account_name' => 'PT MotoRent Indonesia',
                'steps' => [
                    'Buka aplikasi Livin\' by Mandiri.',
                    'Pilih menu Transfer ke Bank Mandiri.',
                    'Masukkan nomor rekening 1122 3344 55.',
                    'Masukkan nominal transfer sesuai total.',
                    'Konfirmasi transfer dan simpan bukti.',
                ],
            ],
            'bni' => [
                'name' => 'BNI',
                'type' => 'transfer',
                'account_number' => '6677 8899 00',
                'account_name' => 'PT MotoRent Indonesia',
                'steps' => [
                    'Buka aplikasi BNI Mobile Banking.',
                    'Pilih menu Transfer ke BNI.',
                    'Masukkan nomor rekening 6677 8899 00.',
                    'Masukkan nominal transfer sesuai total.',
                    'Konfirmasi transfer dan simpan bukti.',
                ],
            ],
            'gopay' => [
                'name' => 'GoPay',
                'type' => 'ewallet',
                'account_number' => '0812 3456 7890',
                'account_name' => 'PT MotoRent Indonesia',
                'steps' => [
                    'Buka aplikasi Gojek.',
                    'Pilih menu GoPay dan tap "Kirim".',
                    'Masukkan nomor 0812 3456 7890.',
                    'Masukkan nominal sesuai total.',
                    'Konfirmasi pembayaran.',
                ],
            ],
            'ovo' => [
                'name' => 'OVO',
                'type' => 'ewallet',
                'account_number' => '0812 3456 7891',
                'account_name' => 'PT MotoRent Indonesia',
                'steps' => [
                    'Buka aplikasi OVO.',
                    'Pilih menu Transfer ke OVO.',
                    'Masukkan nomor 0812 3456 7891.',
                    'Masukkan nominal sesuai total.',
                    'Konfirmasi pembayaran.',
                ],
            ],
            'dana' => [
                'name' => 'DANA',
                'type' => 'ewallet',
                'account_number' => '0812 3456 7892',
                'account_name' => 'PT MotoRent Indonesia',
                'steps' => [
                    'Buka aplikasi DANA.',
                    'Pilih menu Kirim ke DANA.',
                    'Masukkan nomor 0812 3456 7892.',
                    'Masukkan nominal sesuai total.',
                    'Konfirmasi pembayaran.',
                ],
            ],
            'qris' => [
                'name' => 'QRIS',
                'type' => 'qris',
                'account_number' => null,
                'account_name' => 'PT MotoRent Indonesia',
                'steps' => [
                    'Buka aplikasi e-wallet atau mobile banking yang mendukung QRIS.',
                    'Pilih menu Scan QRIS.',
                    'Scan kode QR yang ditampilkan.',
                    'Masukkan nominal sesuai total.',
                    'Konfirmasi pembayaran.',
                ],
            ],
        ];
    }

    private function checkExpired(Booking $booking): void
    {
        $payment = $booking->payment;

        if (! $payment) {
            return;
        }

        if (
            $booking->status === 'menunggu pembayaran' &&
            $payment->expires_at &&
            $payment->expires_at->isPast()
        ) {
            $booking->update(['status' => 'dibatalkan']);
            $payment->update(['status' => 'expired']);
        }
    }

    public function show(Booking $booking): View
    {
        abort_unless($booking->user_id === request()->user()->id || request()->user()->isAdmin(), 403);

        $booking->load(['motor.brand', 'motor.type', 'pickupLocation', 'payment']);

        $this->checkExpired($booking);

        $backUrl = route('account.show') . '#account-activity';
        $paymentMethods = $this->getPaymentMethods();
        $selectedMethod = $booking->payment?->method;
        $methodData = $selectedMethod ? ($paymentMethods[$selectedMethod] ?? null) : null;
        $isExpired = $booking->status === 'dibatalkan';

        return view('bookings.show', [
            'booking' => $booking,
            'backUrl' => $backUrl,
            'paymentMethods' => $paymentMethods,
            'methodData' => $methodData,
            'selectedMethod' => $selectedMethod,
            'isExpired' => $isExpired,
            'expiresAt' => $booking->payment?->expires_at,
        ]);
    }

    public function selectMethod(Request $request, Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === $request->user()->id || $request->user()->isAdmin(), 403);

        $this->checkExpired($booking);

        if ($booking->status === 'dibatalkan') {
            return back()->with('error', 'Pesanan sudah dibatalkan karena melewati batas waktu pembayaran.');
        }

        $data = $request->validate([
            'payment_method' => ['required', 'in:' . implode(',', array_keys($this->getPaymentMethods()))],
        ]);

        $booking->payment?->update([
            'method' => $data['payment_method'],
        ]);

        return back()->with('status', 'Metode pembayaran berhasil dipilih. Silakan lakukan pembayaran.');
    }

    public function confirmForm(Booking $booking): View
    {
        abort_unless($booking->user_id === request()->user()->id || request()->user()->isAdmin(), 403);

        $booking->load(['motor.brand', 'pickupLocation', 'payment']);
        $this->checkExpired($booking);

        if ($booking->status === 'dibatalkan') {
            abort(403, 'Pesanan sudah dibatalkan.');
        }

        if (blank($booking->payment?->method)) {
            return redirect()->route('bookings.show', $booking)->with('error', 'Pilih metode pembayaran terlebih dahulu.');
        }

        $paymentMethods = $this->getPaymentMethods();
        $methodData = $paymentMethods[$booking->payment->method] ?? null;

        return view('payments.confirm', [
            'booking' => $booking,
            'methodData' => $methodData,
        ]);
    }

    public function confirm(Request $request, Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === $request->user()->id || $request->user()->isAdmin(), 403);

        $this->checkExpired($booking);

        if ($booking->status === 'dibatalkan') {
            return back()->with('error', 'Pesanan sudah dibatalkan karena melewati batas waktu pembayaran.');
        }

        if (blank($booking->payment?->method)) {
            return redirect()->route('bookings.show', $booking)->with('error', 'Pilih metode pembayaran terlebih dahulu.');
        }

        $data = $request->validate([
            'proof' => ['required', 'image', 'max:5120'],
            'payer_name' => ['required', 'string', 'max:120'],
        ]);

        $file = $request->file('proof');
        $path = $file->store('payment-proofs/' . now()->format('Y/m'), 'public');

        $booking->payment->update([
            'proof_path' => $path,
            'status' => 'menunggu verifikasi',
        ]);

        $booking->update(['status' => 'menunggu verifikasi']);

        return redirect()->route('bookings.show', $booking)->with('status', 'Bukti pembayaran berhasil diunggah. Mohon tunggu verifikasi dari admin.');
    }

    public function cancel(Request $request, Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === $request->user()->id || $request->user()->isAdmin(), 403);

        if (! in_array($booking->status, ['menunggu pembayaran'], true)) {
            return back()->with('error', 'Pesanan ini tidak dapat dibatalkan.');
        }

        $booking->update(['status' => 'dibatalkan']);
        $booking->payment?->update(['status' => 'dibatalkan']);

        return redirect()->route('bookings.show', $booking)->with('status', 'Pesanan berhasil dibatalkan.');
    }

    public function invoice(Booking $booking): View
    {
        abort_unless($booking->user_id === request()->user()->id || request()->user()->isAdmin(), 403);

        $booking->load(['motor.brand', 'motor.type', 'pickupLocation', 'payment', 'user']);

        $paymentMethods = $this->getPaymentMethods();
        $methodData = $booking->payment?->method ? ($paymentMethods[$booking->payment->method] ?? null) : null;

        return view('payments.invoice', [
            'booking' => $booking,
            'methodData' => $methodData,
        ]);
    }
}
