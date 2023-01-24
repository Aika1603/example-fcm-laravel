<div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Brand-->
    <div class="header-brand">
        <!--begin::Logo-->
        <a href="{{ route('dashboard') }}">
            <img alt="Logo" src="{{ asset('images/icon.png') }}" class="h-40px h-lg-60px" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside minimize-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-minimize" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr092.svg-->
            <span class="svg-icon svg-icon-1 me-n1 minimize-default">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="8.5" y="11" width="12" height="2" rx="1" fill="black" />
                    <path d="M10.3687 11.6927L12.1244 10.2297C12.5946 9.83785 12.6268 9.12683 12.194 8.69401C11.8043 8.3043 11.1784 8.28591 10.7664 8.65206L7.84084 11.2526C7.39332 11.6504 7.39332 12.3496 7.84084 12.7474L10.7664 15.3479C11.1784 15.7141 11.8043 15.6957 12.194 15.306C12.6268 14.8732 12.5946 14.1621 12.1244 13.7703L10.3687 12.3073C10.1768 12.1474 10.1768 11.8526 10.3687 11.6927Z" fill="black" />
                    <path opacity="0.5" d="M16 5V6C16 6.55228 15.5523 7 15 7C14.4477 7 14 6.55228 14 6C14 5.44772 13.5523 5 13 5H6C5.44771 5 5 5.44772 5 6V18C5 18.5523 5.44771 19 6 19H13C13.5523 19 14 18.5523 14 18C14 17.4477 14.4477 17 15 17C15.5523 17 16 17.4477 16 18V19C16 20.1046 15.1046 21 14 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H14C15.1046 3 16 3.89543 16 5Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr076.svg-->
            <span class="svg-icon svg-icon-1 minimize-active">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black" />
                    <path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black" />
                    <path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside minimize-->
        <!--begin::Aside toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <i class="bi bi-menu-button-wide fs-1"></i>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Aside toggle-->
    </div>
    <!--end::Brand-->
    <!--begin::Toolbar-->
    <div class="toolbar d-flex align-items-stretch">
        <!--begin::Toolbar container-->
        <div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
            <!--begin::Page title-->
            <div class="page-title d-flex justify-content-center flex-column me-5">
                <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">
                    {{ $title ?? 'Laravel Project' }}
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray w-5px h-2px"></span>
                    </li>                    
                    
                </ul>
            </div>
            <!--end::Page title-->
            <!--begin::Action group-->
            <div class="d-flex align-items-stretch overflow-auto pt-3 pt-lg-0">
                <!--begin::Notifications-->
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <div class="btn btn-icon  btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px position-relative" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <i class="bi bi-bell fs-1"></i>
                        <span class="badge badge-square badge-danger" id="jumlah_notif">0</span>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
                        <div class="d-flex flex-column bgi-no-repeat rounded-top bg-primary" >
                            <h3 class="text-white fw-bold px-9 mt-10 mb-6">Notifications 
                                <br/>
                                <button type="button" class="btn btn-mark-read btn-light btn-sm mt-3 " >Mark all as read </button>
                                <input  type="hidden" value="0" id="last_id" >
                            </h3>
                        </div>
                        <div class="scroll-y mh-325px my-5 px-8"  id="notification">
                            <div class="d-flex flex-stack py-4">
                                <div class="d-flex align-items-center"  data-kt-indicator="on">
                                    <span class="indicator-progress">
                                        Loading ... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="py-3 text-center border-top">
                            <a href="{{ url('/notification') }}" class="btn btn-color-gray-600 btn-active-color-primary">View All 
                                <span class="svg-icon svg-icon-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Notifications-->

                <!--begin::Theme mode-->
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                   
                </div>
                <!--end::Theme mode-->
            </div>
            <!--end::Action group-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
</div>

<script>
    (function() {
        notification();
        setInterval(notification, 5000);
        var baseurl = "{{ url('') }}";
        $(".btn-mark-read").hide();
        $('#jumlah_notif').hide();

        function notification() {
            let last_id = $('#last_id').val();
            $.ajax({
                url: "{{ url('notification/get') }}/"+last_id,
                contentType: "application/json",
                cache: false,
                dataType: 'json',
                success: function(result) {
                    var notif = "";
                    if (result.status && result.all != 0) {
                        $.each(result.content, function(i, item) {
                            var trimmedString = item.message.length > 150 ?
                                item.message.substring(0, 150 - 3) + "..." :
                                item.message;
                            let status = ''
                            if (item.is_seen == "0") {
                                status = '<span class="bullet bullet-dot bg-danger h-8px w-8px position-absolute translate-middle top-0 start-100 animation-blink-unactive"></span>';
                            }
                            let link = "{{ url('notification/view/') }}";
                            notif += `
                            <a href="${link+'/'+item.id}" style="text-decoration:none;">
                                <div class="d-flex flex-stack py-4 ">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-4 position-relative">
                                            <span class="symbol-label bg-light-${item.type}">
                                                <span class="svg-icon svg-icon-2 svg-icon-${item.type}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"/>
                                                        <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"/>
                                                    </svg>
                                                </span>
                                            </span>
                                            ${status}
                                        </div>
                                        <div class="mb-0 me-2">
                                            <div class="fs-6 text-gray-800 text-hover-${item.type} fw-bolder">${item.title}</div>
                                            <div class="text-dark fs-7">${trimmedString}</div>
                                            <span class="badge badge-light mt-1 ">${item.created_at}</span>
                                        </div>
                                    </div>
                                </div>
                            </a> 
                            `;
                        });
                        if (result.unseen >= 1) {
                            $(".btn-mark-read").show();
                            $("#jumlah_notif").show();
                            $('#jumlah_notif').text(result.unseen);
                        } else {
                            $(".btn-mark-read").hide();
                            $('#jumlah_notif').hide();
                        }
                        $('#notification').html(notif);
                    } else {
                        notif = `
                            <div class="d-flex flex-column px-9">
                                <div class="pt-10 pb-0">
                                    <h3 class="text-dark text-center fw-bolder">Tidak ada notifikasi</h3>
                                    <div class="text-center text-gray-600 fw-bold pt-1">Anda belum memiliki notifikasi apapun untuk ditampilkan</div>
                                </div>
                                <div class="text-center px-4">
                                    <img class="mw-100 mh-200px" alt="image" src="{{ asset('src/media/illustrations/sigma-1/8.png') }}" />
                                </div>
                            </div>
                        `;
                        $('#notification').html(notif);
                    }
                    //last_id
                    $('#last_id').val(result.last_id);

                    // check new notif
                    if(result.new > 0){
                        let notif = result.new > 1 ? `You have ${result.new} new notifications` : `You have a new notification`;
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toastr-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.info(notif);
                        // $('title').html(notif+' - ');
                        // document.getElementById('audio-notif').play();
                    }

                },
                error: function() {
                    console.warn('Notification interval has been fail!');
                }
            })
        }

        $('.btn-mark-read').click(() => {
            $('.btn-mark-read').prop('disabled', true).html('Loading')
            $.ajax({
                url: "{{ url('notification/read-all/') }}",
                contentType: "application/json",
                cache: false,
                dataType: 'json',
                success: function(result) {
                    Swal.fire("Success", result.message , "success").then((value) => {
                                        window.location.replace('');
                                    });
                    $('.btn-mark-read').prop('disabled', false).html('Mark all as read')
                },
                error: function(res){
                    $('.btn-mark-read').prop('disabled', false).html('Mark all as read')
                }
            });
        })
    })();

    const titleMarquee = (status = true) => {
        if(status){
            var titleText = document.title;
            titleText = titleText.substring(1, titleText.length) + titleText.substring(0, 1);
            document.title = titleText;
            setTimeout("titleMarquee()", 450);
        }else{
            return false;
        }
    }
</script>


