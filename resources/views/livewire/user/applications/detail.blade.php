<div>
    <div class="flex gap-x-2">
        <button class="btn btn_primary uppercase" data-toggle="modal" data-target="#detail-publication-{{$publication->id}}"><i class="las la-info ltr:mr-2 rtl:ml-2"></i> Detalle</button>
    </div>

    <!-- Basic -->
    <div wire:ignore.self id="detail-publication-{{$publication->id}}"  class="modal" data-animations="fadeInDown, fadeOutUp" Data-keyword="false">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Evento {{ $publication->event->name }}</h2>
                    <button type="button" class="close la la-times" data-dismiss="modal"></button>
                </div>
                <form action="" wire:submit.prevent="save">
                    <div class="modal-body">

                        <div class="card card_column">
                            <div class="image">
                                <div class="aspect-w-4 aspect-h-3">
                                    <img src="assets/images/tomato.jpg">
                                </div>
                                <label class="custom-checkbox absolute top-0 ltr:left-0 rtl:right-0 mt-2 ltr:ml-2 rtl:mr-2">
                                    <input type="checkbox" data-toggle="cardSelection">
                                    <span></span>
                                </label>
                                <div
                                    class="badge badge_outlined badge_secondary uppercase absolute top-0 ltr:right-0 rtl:left-0 mt-2 ltr:mr-2 rtl:ml-2">
                                    Draft</div>
                            </div>
                            <div class="header">
                                <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h5>
                            </div>
                            <div class="body">
                                <h6 class="uppercase">Views</h6>
                                <p>100</p>
                                <h6 class="uppercase mt-4">Date Created</h6>
                                <p>December 15, 2019</p>
                            </div>
                            <div class="actions">
                                <a href="#" class="btn btn-icon btn_outlined btn_secondary">
                                    <span class="la la-pen-fancy"></span>
                                </a>
                                <a href="#" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                                    <span class="la la-trash-alt"></span>
                                </a>
                                <div class="dropdown ltr:ml-auto rtl:mr-auto ltr:-mr-3 rtl:-ml-3">
                                    <button class="btn-link" data-toggle="dropdown-menu">
                                        <span class="la la-ellipsis-v text-4xl leading-none"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#">Dropdown Action</a>
                                        <a href="#">Link</a>
                                        <hr>
                                        <a href="#">Something Else</a>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                
                    </div>
                    
                    <div class="modal-footer">
                        <div class="flex ltr:ml-auto rtl:mr-auto">
                            <button type="button" class="btn btn_secondary uppercase" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
