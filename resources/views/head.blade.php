<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{$pageTitle ?? config('app.name') }}</title>
  @include('meta')

  <link rel="shortcut icon" type="image/png" href="favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    html * {
      margin: 0;
    }

    body {
      background-color: #f3f3f3;
      color: #333;
    }
  </style>
  <style>
    main.landing-page {
      margin-top: 56px;
    }

    #hero-banner {
      background-image: linear-gradient(290deg, #92db94, #fff);
      display: flex;
      justify-content: end;
    }

    #hero-banner img {
      max-width: 100%;
    }

    .fullscreen {
      min-height: calc(100vh - 56px);
    }

    .banner-text h2 {
      font-size: 42px;
      margin: 0 0 32px;
    }

    .banner-text p {
      font-size: 16px;
    }

    .sign-btn {
      gap: 16px;
      margin-bottom: 21px;
    }
    .gradient-custom {
      /* fallback for old browsers */
      background: #6a11cb;

      /* Chrome 10-25, Safari 5.1-6 */
      background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
  </style>
  <style>
    footer {
      background-color: #333;
      color: #a7a7a7;
      padding: 1rem;
      text-align: center;
      font-size: 14px;
    }
  </style>
  <style>
    .background-radial-gradient {
      background-color: hsl(218, 41%, 15%);
      background-image: radial-gradient(650px circle at 0% 0%,
        hsl(218, 41%, 35%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
        hsl(218, 41%, 45%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%);
      min-height: 100vh;
    }

    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
      border-radius: 8px;
    }
  </style>
  <style>
    .user-profile .field .value {
      color: #666;
    }
  </style>
  <style>
    main.auth-user {
      max-width: 600px;
      margin-right: auto;
      margin-left: auto;
    }

    main.auth-user header.navbar {
      height: 50px;
      padding: 0;
    }

    header.navbar a {
      color: inherit;
    }

    section.balance a {
      color: inherit;
      text-decoration: none;
    }

    section.balance button.btn {
      box-shadow: none;
    }

    section.balance .account-balance {
      font-size: 32px;
      font-weight: 500;
      font-family: sans-serif;
    }

    section.balance.balance-star .currency,
    section.balance.balance-star .amount {
      display: none;
    }

    section.balance:not(.balance-star) .star-balance {
      display: none;
    }

    section.services {
      background-color: #fff;
    }

    section.services .services-cards {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-template-rows: auto;
      gap: 16px;
      text-align: center;
    }

    section.services .services-cards .service {
      cursor: pointer;
    }

    section.services .services-cards .service .text {
      font-weight: 600;
      color: #555;
    }

    section.modal .modal-dialog #serviceAirtimeTopUp-ModalBody,
    section.modal .modal-dialog #serviceDataBundle-ModalBody {
      font-family: sans-serif;
      /* display: none; */
    }

    section.modal .modal-dialog #serviceAirtimeTopUp-ModalBody .set-amount {
      border-radius: 16px;
    }

    section.modal .modal-dialog #serviceAirtimeTopUp-ModalBody button {
      color: #777;
    }

    section.modal .modal-dialog #serviceAirtimeTopUp-ModalBody button:focus {
      color: inherit;
    }

    section.modal #serviceDataBundle-ModalBody .data-bundle {
      background-color: rgba(146, 219, 148, .3);
      font-size: 14px;
      cursor: pointer;
    }

    section.modal #serviceDataBundle-ModalBody .data-bundle [class^=col] {
      border-color: #010101;
    }

    section.modal #serviceDataBundle-ModalBody .data-bundle .small {
      font-size: 12px;
    }

    section.modal #serviceDataBundle-ModalBody .data-bundle p.small {
      color: #777;
    }

    section.modal #serviceDataBundle-ModalBody .data-bundle p:not(.small) {
      font-weight: 600;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
