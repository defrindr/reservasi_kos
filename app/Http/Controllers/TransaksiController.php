<?php

namespace App\Http\Controllers;

use App\Http\Services\TransaksiService;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function __construct(protected TransaksiService $service) {}

    public function listKamar()
    {
        $pages = $this->service->getListAvailableRooms();

        return view('transaksi.list-room', compact('pages'));
    }

    public function index()
    {
        $pages = $this->service->fetchByStatus(
            request('status', null),
            request('search', ''),
            request('orderBy', 'id'),
            request('orderDirection', 'ASC'),
            request('limit', 10),
            request('paginate', true)
        );
        return view('transaksi.index', compact('pages'));
    }

    public function myTrx()
    {
        $pages = $this->service->getMyTrx();
        return view('transaksi.my-trx', compact('pages'));
    }

    public function booking($id)
    {
        try {
            $success = $this->service->bookRoom($id);
            if (!$success) {
                return redirect()->route('transaksi.list-kamar')->with('error', 'Kamar sedang tersedia');
            }
            return redirect()->route('transaksi.my-trx')->with('success', 'Room booked');
        } catch (\Throwable $th) {
            return redirect()->route('transaksi.list-kamar')->with('error', $th->getMessage());
        }
    }

    public function cancelBooking($id)
    {
        try {
            $success = $this->service->cancelBooking($id);
            if (!$success) {
                return redirect()->route('transaksi.my-trx')->with('error', 'Failed to cancel booking');
            }
            return redirect()->route('transaksi.my-trx')->with('success', 'Booking cancelled');
        } catch (\Throwable $th) {
            return redirect()->route('transaksi.my-trx')->with('error', $th->getMessage());
        }
    }

    public function confirm($id)
    {
        try {
            $success = $this->service->confirm($id);
            if (!$success) {
                return redirect()->route('transaksi.index')->with('error', 'Failed to confirm booking');
            }
            return redirect()->route('transaksi.index')->with('success', 'Booking confirmed');
        } catch (\Throwable $th) {
            return redirect()->route('transaksi.index')->with('error', $th->getMessage());
        }
    }

    public function submitBuktiTf($id, Request $request)
    {
        try {
            $file = $request->file('bukti_pembayaran');
            $success = $this->service->submitBuktiTf($id, $file);
            if (!$success) {
                return redirect()->route('transaksi.my-trx')->with('error', 'Failed to submit bukti transfer');
            }
            return redirect()->route('transaksi.my-trx')->with('success', 'Bukti transfer submitted');
        } catch (\Throwable $th) {
            return redirect()->route('transaksi.my-trx')->with('error', $th->getMessage());
        }
    }

    public function confirmPayment($id)
    {
        try {
            $success = $this->service->confirmPayment($id);
            if (!$success) {
                return redirect()->route('transaksi.index')->with('error', 'Failed to confirm payment');
            }
            return redirect()->route('transaksi.index')->with('success', 'Payment confirmed');
        } catch (\Throwable $th) {
            return redirect()->route('transaksi.index')->with('error', $th->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            $success = $this->service->reject(
                $id,
                request('komentar', '')
            );
            if (!$success) {
                return redirect()->route('transaksi.index')->with('error', 'Failed to reject booking');
            }
            return redirect()->route('transaksi.index')->with('success', 'Booking rejected');
        } catch (\Throwable $th) {
            return redirect()->route('transaksi.index')->with('error', $th->getMessage());
        }
    }
}
