<x-layouts.app title="Pembayaran">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <div class="text-center mt-10">
        <h2 class="text-2xl font-bold mb-4">Konfirmasi Pembayaran</h2>
        <p>Anda akan upgrade ke Paket Pro seharga <strong>Rp 50.000</strong></p>
        
        <button id="pay-button" class="mt-6 bg-blue-600 text-white py-3 px-8 rounded font-bold hover:bg-blue-700">
            Bayar Sekarang
        </button>
    </div>

    <script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            alert("Pembayaran Berhasil!");
            window.location.href = "/dashboard"; // Redirect ke dashboard
          },
          onPending: function(result){
            alert("Menunggu pembayaran!");
          },
          onError: function(result){
            alert("Pembayaran gagal!");
          },
          onClose: function(){
            alert('Anda menutup popup tanpa menyelesaikan pembayaran');
          }
        })
      });
    </script>
</x-layouts.app>