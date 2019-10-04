<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Project Test</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <meta name="description" content="@yield('description')" />
  <!-- Bootstrap 4.0.0 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    /* Sticky Footer Classes */
    html,
    body {
      height: 100%;
    }

    #page-content {
      flex: 1 0 auto;
    }

    #sticky-footer {
      flex-shrink: none;
    }

    /* Other Classes for Page Styling */

    body {
      background: #ffffff;
      background: linear-gradient(to right, #ffffff, #f4f4f4);
    }

    #page-content .container .justify-content-center {
      margin: 10px auto;
      border-radius: 5px;
      background-color: #fff;
      border: 1px solid #009aff;
      padding: 37px 0 63px;
    }

    .navbar {
     background-color: #95d5ff !important;
    }

    #sticky-footer {
        background-color: #54bbff !important;
    }

    #page-content > .container.text-center {
        text-align: center!important;
        min-height: 273px;
    }

    .list-group-item .form-control {
        padding: 0;
        width: auto;
        display: block;
        float: left;
    }

    .list-group-item {
        line-height: 38px;
        max-width: 63%;
    }

    .list-group-item span[data-name="deleteTask"] {
        cursor: pointer;
        margin-left: 14px;
    }

    form[data-name="form-remove"] .btn-danger {
      margin-top: 18px;
      display: none;
    }
  </style>
  <!-- Scripts -->
  <script>
    window.Laravel = <?php echo json_encode([
      'csrfToken' => csrf_token(),
    ]); ?>
  </script>
</head>
<body class="d-flex flex-column">
    <div id="page-content">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">Project Test</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
      <!-- Content Wrapper. Contains page content -->
      <div class="container text-center">
        @yield('content')
      </div>
      <footer id="sticky-footer" class="py-4 bg-dark text-black-50">
        <div class="container text-center">
          <small>Copyright &copy; <a href="mailto: setiady.mulya@gmail.com">setiady.mulya@gmail.com</a></small>
        </div>
      </footer>
    </div>
    <!-- ./wrapper -->
    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @yield("script")
</body>
</html>