@extends('layouts.master')

@section('content')
    <form id="user_form" action="{{ route('users.store') }}" method="post">
        @php $form_type ='create' @endphp
		@include('users/_form')
    </form>
@stop

@section('includes')

    <style>
    </style>

@stop
        

@section('scripts')

    <script src="{{asset('plugins/bootstrapvalidator/bootstrapValidator.min.js')}}"></script>
    
    <script>

        $(document).ready(function() {

            $('#user_form').bootstrapValidator({
                fields: {
                    password: {
                        validators: {
                            notEmpty: {
                                    message: 'The password is required and cannot be empty'
                            },
                            identical: {
                                field: 'password_confirmation',
                                message: 'The password and its confirm are not the same'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Password minimum 6 characters'
                            }
                        }
                    },
                    confirmpassword: {
                        validators: {
                            notEmpty: {
                                    message: 'The password is required and cannot be empty'
                            },
                            identical: {
                                field: 'password',
                                message: 'The password and its confirm are not the same'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Password minimum 6 characters'
                            }
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required and cannot be empty'
                            },
                            stringLength: {
                                min: 3,
                                message: 'Password minimum 3 characters'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required and cannot be empty'
                            }
                        }   
                    },
                    phone_no: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required and cannot be empty'
                            }
                        }   
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required and cannot be empty'
                            }
                        }   
                    }
                }
            });

            $('#user_form').submit(function(event){
                event.preventDefault(); //prevent default action 
                var post_url = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data = new FormData(this); //Creates new FormData object
                $.ajax({
                    url : post_url,
                    type: request_method,
                    data : form_data,
                    contentType: false,
                    cache: false,
                    processData:false
                }).done(function(response){
                    window.location.replace('/users');
                });
            });
        });

    </script>

@stop