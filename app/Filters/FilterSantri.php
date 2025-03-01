<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FilterSantri implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            session()->setFlashdata('pesan', 'Anda belum login! Silahkan login terlebih dahulu.');
            return redirect()->to(base_url());
        }

        // Cek apakah user adalah santri
        if (session()->get('level') !== 'santri') {
            session()->setFlashdata('pesan', 'Anda tidak memiliki akses ke halaman tersebut!');
            return redirect()->to(base_url());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
