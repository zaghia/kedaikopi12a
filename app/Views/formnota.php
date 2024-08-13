 <div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Nota Pembelian</h3>
                
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                       
                    </ol>
                </nav>
            </div>
        </div>

    </div>


 <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?= base_url('home/adminnota')?>" method="POST" enctype="multipart/form-data">
                            <form class="form">
                                <div class="">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Tanggal Awal</label>
                                            <input type="date" class="form-control" id="kode" name="awal">
                                        </div>
                                    </div>

                                  


                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal Akhir</label>
                                             <input type="date" class="form-control" id="kode" name="akhir">
                                        </div>
                                    </div>
                                    
                                   
                                    
                                   
                                    
                                   
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-secondary me-1 mb-1">Print Nota</button>
                                       
                                    </div>
                                </div>
                            </form>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>

          <!--   <div class="col-4">
                <div class="card">
                    <div class="card-header">
                      
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?= base_url('home/pdf')?>" method="POST" enctype="multipart/form-data">
                            <form class="form">
                                <div class="">
                                    <div class="col-md-12 col-12">
                                         <div class="form-group">
                                            <label for="first-name-column">Tanggal Awal</label>
                                            <input type="date" class="form-control" id="kode" name="awal">
                                        </div>
                                    </div>

                                  


                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal Akhir</label>
                                             <input type="date" class="form-control" id="kode" name="akhir">
                                        </div>
                                    </div>
                                    
                                   
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">PDF</button>
                                       
                                    </div>
                                </div>
                            </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                       
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?= base_url('home/excel')?>" method="POST" enctype="multipart/form-data">
                            <form class="form">
                                <div class="">
                                    <div class="col-md-12 col-12">
                                         <div class="form-group">
                                            <label for="first-name-column">Tanggal Awal</label>
                                            <input type="date" class="form-control" id="kode" name="awal">
                                        </div>
                                    </div>

                                  


                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal Akhir</label>
                                             <input type="date" class="form-control" id="kode" name="akhir">
                                        </div>
                                    </div>
                                    
                                   
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Excel</button>
                                       
                                    </div>
                                </div>
                            </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
   
        
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>