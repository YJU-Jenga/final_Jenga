<script>
  function comfirm() {
    if(document.getElementById('password').value == {{$password}}){
      
    } else {
      event.preventDefault();
      alert('비밀번호가 맞지 않습니다.');
    }
  }
</script>