<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Razorpay</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<style>
   body{
    background-image: url(../images/paymentbg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    width: 100%;
    height: 100vh;
   }
   h1{
    color: whitesmoke;
   }
</style>
</head>
<body>
    <div class="image"></div>
    
    <div class="container col-lg-3 pt-5">
      <h1>Pencil</h1>
        <form action="/payment" method="POST">
          @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label text-white">Enter name</label>
              <input type="text" class="form-control " name="name" placeholder="Enter your name">
              
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label text-white">Enter Amount</label>
              <input type="number" class="form-control" name="amount" placeholder="Enter your amount">
            </div>
            <button type="submit" class="btn btn-primary " id="paybtn">Pay Now</button>
          </form>
    </div>

    @if(Session::has('data'))
      
      <style>
        .container{
          display: none;
        }
      </style>
      <form action="/pay" method="POST" class="text-center mx-auto mt-5">
        @csrf
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="rzp_test_KpdqgY3DYvB01n"
      data-amount="{{ Session::get('amount') }}"; 
            data-currency="INR"
      data-order_id="{{Session::get('data.order_id')}}"
            data-buttontext="Pay with Razorpay"
            data-name="Pencil"
            data-description="Test transaction"
            data-theme.color="#F37254"
        ></script>
        <input type="hidden" custom="Hidden Element" name="hidden">
        </form>
    @endif

    
  
      
</body>
</html>