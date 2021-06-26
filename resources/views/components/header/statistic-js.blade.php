<script src="{{ asset('assets\js\currency.min.js') }}"></script>
<script>
  var span_total = document.getElementById('total-pendapatan');
  var span_val = document.getElementById('total-pendapatan').textContent;
  span_total.textContent = "Rp" + currency(span_val, { decimal: '.', separator: ' ', symbol :' '}).format(); // => " 1.234,56"
  console.log(span_total.textContent);
</script>