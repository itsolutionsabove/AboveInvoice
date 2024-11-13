<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    {{$global->page->title}}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                      @php
                      if($global->page->back ?? false){
                      @endphp
                        <a href="{{$global->page->back_url}}" class="btn">
                          {{$global->page->back}}
                        </a>
                      @php
                      }
                      @endphp
                  </span>
                </div>
            </div>
        </div>
    </div>
</div>
