<?php

// Function to return the name of a person on every call
function generateRandomLot($length=5)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">CLOA</h1>
<p class="mb-4">Certificate of Land Ownership Award</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="btn-group pull-right" style="float:right;">
            <a href="#" class="btn btn-primary btn-sm btn-icon-split" data-toggle="modal" data-target=".bd-example-modal-lg">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Entry</span>
            </a>
            <a href="#" class="btn btn-danger btn-sm btn-icon-split" onclick='deleteEntry()' id='btn_delete'>
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Delete Entry</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>CLOA No.</th>
                        <th>TCT OR OCT No.</th>
                        <th>Sequence No.</th>
                        <th>Date Generated</th>
                        <th>Date Registered</th>
                        <th>Date Issued</th>
                        <th>Lot No</th>
                        <th>Survey No</th>
                        <th>Total Area (sqm)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i=1;$i<3;$i++){
                            $tct = rand(1000,10000);
                            $survey = rand(1000,10000);
                            $lot_area = rand(1,10000);

                            
                            $timestamp = mt_rand(1, time());
                            $timestamp2 = mt_rand(1, time());
                            $timestamp3 = mt_rand(1, time());
                            $randomDate = date("m/d/Y", $timestamp);
                            $randomDate2 = date("m/d/Y", $timestamp2);
                            $randomDate3= date("m/d/Y", $timestamp3);

                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><center><button class='btn btn-info btn-circle btn-sm'><span class='fa fa-pen'></span></button></center></td>
                        <td><?=generateRandomLot()?></td>
                        <td><?= $tct?></td>
                        <td><?= sprintf("%05d",$i)?></td>
                        <td><?= $randomDate?></td>
                        <td><?= $randomDate2?></td>
                        <td><?= $randomDate3?></td>
                        <td><?=generateRandomLot()?></td>
                        <td><?= $survey?></td>
                        <td><?=number_format($lot_area,2)?> m<sup>2</sup></td>
                    </tr>
                   <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
            <input type="hidden" name="hidden_id" id="hidden_id" required>
            <input type="hidden" name="module" id="module" required>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <div class="col">
                    <label for="recipient-name" class="col-form-label">Lot No:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="col">
                    <label for="recipient-name" class="col-form-label">Survey No:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Location of Property:</label>
                <textarea class="form-control" id="message-text"></textarea>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Coordinates:</label>
                    <input type="text" class="form-control" id="recipient-name">
            </div>
        </div>
        <div class="modal-footer">
            <div class='btn-group'>
                <button type="submit" class="btn btn-primary btn-sm" id="btn_submit"><span class='fa fa-check-circle'></span> Submit</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
            </div>
        </div>
    </div>
  </div>
</div>