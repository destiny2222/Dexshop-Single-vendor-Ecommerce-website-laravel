<section class="tp-search-area">
    <div class="container">
       <div class="row">
          <div class="col-xl-12">
             <div class="tp-search-form">
                <div class="tp-search-close text-center mb-20">
                   <button class="tp-search-close-btn tp-search-close-btn"></button>
                </div>
                <form action="{{ route('search-product') }}" method="GET">
                   <div class="tp-search-input mb-10">
                      <input type="text" name="query" placeholder="Search for product...">
                      <button type="submit"><i class="flaticon-search-1"></i></button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </section>
