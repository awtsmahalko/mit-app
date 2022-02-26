<?php

// Function to return the name of a person on every call
function generateRandomName()
{
    $firstname = array(
        'Johnathon',
        'Anthony',
        'Erasmo',
        'Raleigh',
        'Nancie',
        'Tama',
        'Camellia',
        'Augustine',
        'Christeen',
        'Luz',
        'Diego',
        'Lyndia',
        'Thomas',
        'Georgianna',
        'Leigha',
        'Alejandro',
        'Marquis',
        'Joan',
        'Stephania',
        'Elroy',
        'Zonia',
        'Buffy',
        'Sharie',
        'Blythe',
        'Gaylene',
        'Elida',
        'Randy',
        'Margarete',
        'Margarett',
        'Dion',
        'Tomi',
        'Arden',
        'Clora',
        'Laine',
        'Becki',
        'Margherita',
        'Bong',
        'Jeanice',
        'Qiana',
        'Lawanda',
        'Rebecka',
        'Maribel',
        'Tami',
        'Yuri',
        'Michele',
        'Rubi',
        'Larisa',
        'Lloyd',
        'Tyisha',
        'Samatha',
    );

    $lastname = array(
        'Mischke',
        'Serna',
        'Pingree',
        'Mcnaught',
        'Pepper',
        'Schildgen',
        'Mongold',
        'Wrona',
        'Geddes',
        'Lanz',
        'Fetzer',
        'Schroeder',
        'Block',
        'Mayoral',
        'Fleishman',
        'Roberie',
        'Latson',
        'Lupo',
        'Motsinger',
        'Drews',
        'Coby',
        'Redner',
        'Culton',
        'Howe',
        'Stoval',
        'Michaud',
        'Mote',
        'Menjivar',
        'Wiers',
        'Paris',
        'Grisby',
        'Noren',
        'Damron',
        'Kazmierczak',
        'Haslett',
        'Guillemette',
        'Buresh',
        'Center',
        'Kucera',
        'Catt',
        'Badon',
        'Grumbles',
        'Antes',
        'Byron',
        'Volkman',
        'Klemp',
        'Pekar',
        'Pecora',
        'Schewe',
        'Ramage',
    );

    $name = $firstname[rand(0, count($firstname) - 1)];
    $name .= ' ';
    $name .= $lastname[rand(0, count($lastname) - 1)];

    return $name;
}
?>
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ARB's Beneficiaries</h1>
<p class="mb-4">Here you can manage all the ARB's beneficiaries.</p>

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
                        <th>Name of ARB/s in the existing CCLOA</th>
                        <th>Sex</th>
                        <th>Date of Birth</th>
                        <th>Residential Address</th>
                        <th>Present Status</th>
                        <th>Date of Installation</th>
                        <th>Availability of ODC</th>
                        <th>Requesting Parcelization</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $address = array('Bacolod','Bago','Pulupandan');
                        $gender = array('F','M');
                        $request = array('Yes','No');
                        $doc = array("<span class='badge badge-success'>with</span>","<span class='badge badge-danger'>without</span>");
                        $status = array(
                            "<span class='badge badge-info'>Actual tiller/occupant farm worker</span>",
                            "<span class='badge badge-danger'>Deceased</span>",
                            "<span class='badge badge-warning'>Transfer Action</span>"
                        );
                        for($i=1;$i<5;$i++){
                            $random_gender = array_rand($gender,1);
                            $random_status = array_rand($status,1);
                            $random_doc = array_rand($doc,1);
                            $random_request = array_rand($request,1);
                            $random_address = array_rand($address,1);

                            $timestamp = mt_rand(1, time());
                            $timestamp2 = mt_rand(1, time());
                            $randomDate = date("m/d/Y", $timestamp);
                            $randomDate2 = date("m/d/Y", $timestamp2);
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><center><button class='btn btn-info btn-circle btn-sm'><span class='fa fa-pen'></span></button></center></td>
                        <td><?=generateRandomName()?></td>
                        <td><?= $gender[$random_gender]?></td>
                        <td><?=$randomDate?></td>
                        <td><?= $address[$random_address]?></td>
                        <td><?= $status[$random_status]?></td>
                        <td><?=$randomDate2?></td>
                        <td><?= $doc[$random_doc]?></td>
                        <td><?= $request[$random_request]?></td>
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
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Beneficiary:</label>
                <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="recipient-name" class="col-form-label">Sex:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Male
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                            Female
                        </label>
                    </div>
                </div>
                <div class="col">
                    <label for="recipient-name" class="col-form-label">Date of Birth:</label>
                    <input type="date" class="form-control" id="recipient-name">
                </div>
                <div class="col">
                    <label for="recipient-name" class="col-form-label">Present Status:</label>
                    <select class="form-control">
                        <option>&mdash; Please Select &mdash;</option>
                        <option>Actual tiller / farm worker</option>
                        <option>Deceased</option>
                        <option>Transfer Action</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Address:</label>
                <textarea class="form-control" id="message-text"></textarea>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="recipient-name" class="col-form-label">Date of Installation:</label>
                    <input type="date" class="form-control" id="recipient-name">
                </div>
                <div class="col">
                    <label for="recipient-name" class="col-form-label">Availabilty of ODC:</label>
                    <select class="form-control">
                        <option>&mdash; Please Select &mdash;</option>
                        <option>with</option>
                        <option>without</option>
                    </select>
                </div>
                <div class="col">
                    <label for="recipient-name" class="col-form-label">Requesting Parcelization:</label>
                    <select class="form-control">
                        <option>&mdash; Please Select &mdash;</option>
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
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