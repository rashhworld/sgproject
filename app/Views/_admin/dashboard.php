<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/') ?>">SG PROJECTS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      </ul>
      <a style="font-size: 17px" class="nav-link fw-bold text-danger" href="<?= base_url('AdminControl/logout') ?>">Admin, Logout</a>
    </div>
  </div>
</nav>

<?php
$fullRegCnt = 0;
foreach ($ptnrData as $pd) {
  foreach ($pd['pRegData'] as $pg) {
    // echo $pd['pName'] . ", " . $pg['orgName'] . "<br><br>";
    $fullRegCnt++;
  }
}
?>

<div class="card mt-5">
  <div class="card-body">
    <p class="mb-3 text-primary">Total Registration: <b><?= sizeof($ptnrData) ?></b> | Full Registration: <b><?= $fullRegCnt ?></b></p>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <tr>
          <th>Sl. No</th>
          <th>Partner Name</th>
          <th>Partner State</th>
          <th>Partner Mobile</th>
          <th>Partner Organization Type</th>
          <th>Partner joining Date</th>
          <th>Action Type</th>
        </tr>
        <?php $cnt = 1; foreach ($ptnrData as $pd) { ?>
          <tr>
            <td><?= $cnt++ ?></td>
            <td><?= $pd['pName'] ?></td>
            <td><?= $pd['pState'] ?></td>
            <td><?= $pd['pMobile'] ?></td>
            <td><?php
                if ($pd['pOrgType'] == 1) {
                  echo "Non-Government Organization";
                } else if ($pd['pOrgType'] == 2) {
                  echo "Private Limited Organization";
                } else if ($pd['pOrgType'] == 3) {
                  echo "Limited Liability Partnership";
                } else if ($pd['pOrgType'] == 4) {
                  echo "Proprietory Organization";
                }
                ?></td>
            <td><?= date("d/m/Y, g:i a", strtotime($pd['pRegDate'])) ?></td>
            <td>
                <?php if (session()->get('aAccessType') == 0) { ?>
                <a href="JavaScript:void(0)" onclick="deletePartner(this)" pcId="<?= $pd['pcId'] ?>" class="text-decoration-none text-danger me-2"><i class="fa-solid fa-trash"></i> D</a>
                <?php } ?>
              
                <?php if(sizeof($pd['pRegData']) > 0){ ?>
              
                <a href="<?= base_url('admin/partner/' . $pd['pcId'] . "/" . $pd['pOrgType']) ?>" class="text-decoration-none"><i class="fa-solid fa-eye"></i> R</a>

                <a href="JavaScript:void(0)" onclick="partnerApplic('<?= $pd['pcId'] ?>')" class="text-decoration-none text-success mx-2"><i class="fa-solid fa-eye"></i> A</a>

                <a href="JavaScript:void(0)" onclick="emailPartner('<?= $pd['pEmail'] ?>')" class="text-decoration-none text-info"><i class="fa-solid fa-envelope"></i> M</a>

                <?php } else { ?>
                <a href="JavaScript:void(0)" class="text-decoration-none text-danger">Partially Registered</a>
                <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</div>


<!-- send mail to partner -->
<div class="modal fade" id="emailPartner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Partner Mailing System</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
          <div class="col-md-12">
            <label for="pEmail" class="form-label">Enter Partner Email</label>
            <input type="email" class="form-control" name="pEmail" id="pEmail" readonly>
          </div>
          <div class="col-md-12">
            <label for="pMessage" class="form-label">Enter Your Message</label>
            <textarea class="form-control" name="pMessage" id="pMessage" rows="10"></textarea>
          </div>
          <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- partner application -->
<div class="modal fade" id="applicList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Application List</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>Sl No.</th>
              <th>Notification No.</th>
              <th>Applied State</th>
              <th>Applied District</th>
              <th>Application Status</th>
              <th>Application Remarks</th>
            </tr>
            <tr class="data"></tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>