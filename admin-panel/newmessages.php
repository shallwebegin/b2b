<?php require_once 'inc/header.php';?>
    <!-- Sidebar menu-->
    <?php require_once 'inc/sidebar.php';?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Yeni Mesaj Listesi</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo admin;?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active"><a href="#">Yeni Mesaj Listesi</a></li>
        </ul>
      </div>
      <div class="row">

      <form action="<?php echo admin."/messagesearch.php";?>" method="GET" class="col-md-12">
          <div class="form-group">
            <input type="text" name="q" class="form-control" placeholder="Kişi adı ya da e-posta giriniz ve entera tıklayınız" />
          </div>
        </form>

        <form action="" method="GET" class="col-md-2">
          <div class="form-group">
            <input type="text" name="blim" class="form-control" placeholder="Listeleme sayısı" />
          </div>
        </form>
       
      
        <div class="col-md-12">

          <?php   

            $s     = @intval(get('s'));
            if(!$s){
              $s   = 1;
            }


            $blim   = @intval(get('blim'));
            if(!$blim){
              $blim = 50;
            }


          
            $query = $db->prepare("SELECT * FROM mesajlar WHERE mesajdurum=:d ORDER BY id DESC");
            $query->execute([':d' => 2]);

            $total = $query->rowCount();
            $lim   = $blim;
            $show  = $s * $lim - $lim;

            $query = $db->prepare("SELECT * FROM mesajlar WHERE mesajdurum=:d ORDER BY id DESC LIMIT :show,:lim");
            $query->bindValue(':show',(int) $show,PDO::PARAM_INT);
            $query->bindValue(':lim',(int) $lim,PDO::PARAM_INT);
            $query->bindValue(':d',(int) 2,PDO::PARAM_INT);
            $query->execute();

            if($s > ceil($total / $lim)){
              $s = 1;
            }

            if($query->rowCount()){
          ?>


          <div class="tile">
            <h3 class="tile-title">Yeni Mesaj Listesi (<?php echo $total;?>)</h3>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#ID</th>
                    <th>İsim</th>
                    <th>E-posta</th>
                    <th>Konu</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                    <th>İşlem</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach($query as $row){ ?>
                    
                    <tr> 
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['mesajisim'];?></td>
                    <td><?php echo $row['mesajposta'];?></td>
                    <td><?php echo $row['mesajkonu'];?></td>
                    <td><?php echo dt($row['mesajtarih']);?></td>

                    <td><span class="badge badge-danger">Yeni Mesaj</span></td>
                 
                    <td>
                      
                      <a title="Mesajı görüntüle" href="<?php b2b('messageread',$row['id']); ?>"><i class="fa fa-eye"></i></a> | 

                      <a onclick="return confirm('Onaylıyor musunuz?');" title="Mesaj sil" href="<?php b2b('messagedelete',$row['id']);?>"><i class="fa fa-close"></i></a>
                    </td>
                  </tr>

                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>

          <?php }else{

            alert("Yeni Mesaj bulunmuyor","danger");

           } ?>


          <div>
            <ul class="pagination">
              <?php 
                if($total > $lim){
                  if($blim){
                    pagination($s, ceil($total/$lim),'newmessages.php?blim='.$blim.'&s=');
                  }else{
                    pagination($s, ceil($total/$lim),'newmessages.php?s=');



                  }
                }
              ?>	
            </ul>
          </div>

        </div>

      


      </div>
    </main>
    <?php require_once 'inc/footer.php';?>