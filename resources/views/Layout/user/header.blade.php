<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token() }}">
    <title>Your Laravel App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  
    <style>
      
      .sidebar {
     height: 100%;
     width: 250px;
     position: fixed;
     top: 0;
     left: 0;
     background-color: #111;
     padding-top: 60px;
   }

   .sidebar a {
     padding: 15px 25px;
     text-decoration: none;
     font-size: 20px;
     color: white;
     display: block;
     transition: 0.3s;
   }

   .sidebar a:hover {
     background-color: #00bcd4;
     color: black;
   }

   .content {
     margin-left: 250px;
     padding: 20px;
   }
    #dropArea {
      border: 2px dashed #ccc;
      padding: 20px;
      cursor: pointer;
    }
    #imageList {
      list-style: none;
      padding: 0;
    }
    .imageItem {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }
    .imageItem img {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }
   </style>
</head> 

<body>
<div class="sidebar">
    <h2 style = "color:white">Customer Dashboard</h2>
  <a href="{{url('user')}}">Home</a>
  <a href="{{url('user/upload')}}">Upload</a>
  <a href="{{url('user/images')}}">Image List</a>
  <a href="{{url('logout')}}">Logout</a>
</div>
