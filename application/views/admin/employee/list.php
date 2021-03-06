<script type="text/javascript">
    $(document).ready(function () {
    var table = $('#employee_list').dataTable({
            "bJQueryUI": true,
            "bProcessing": true,
            "bServerSide": true,
            "sServerMethod": "GET",
            "sAjaxSource": "employee/ajax_data",
            "iDisplayLength": 50,
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "aaSorting": [[0, 'asc']],
            "sPaginationType": "full_numbers",
            "sDom": 'T<"clear">lfrtip',
            "oTableTools": {
                "sSwfPath": site_url + "js/swf/copy_csv_xls_pdf.swf",
                "aButtons": [
                    "copy",
                    "csv",
                    "xls",
                    {
                        "sExtends": "pdf",
                        "sTitle": "Report Name",
                        "sPdfMessage": "Summary Info",
                        "sPdfOrientation": "landscape",
                        "fnClick": function (nButton, oConfig, flash) {
                            customName = 'employeelist' + ".pdf";
                            flash.setFileName(customName);
                            this.fnSetText(flash,
                                    "title:" + 'Name Of Company: Rangs Ltd' + "\n" +
                                    "message:" + 'Employee List' + "\n" +
                                    "colWidth:" + this.fnCalcColRatios(oConfig) + "\n" +
                                    "orientation:" + oConfig.sPdfOrientation + "\n" +
                                    "size:" + oConfig.sPdfSize + "\n" +
                                    "--/TableToolsOpts--\n" +
                                    this.fnGetTableData(oConfig)
                                    );
                        }
                    },
                    "print"
                ]
            },
            //"sDom": '<"clear">T<"H"Cr><"clear">lfrt<"F"ip>',
            "aoColumns": [
                {"bVisible": true, "bSearchable": false, "bSortable": false},
                {"bVisible": true, "bSearchable": true, "bSortable": true},
                {"bVisible": true, "bSearchable": true, "bSortable": true},
                {"bVisible": true, "bSearchable": true, "bSortable": true},
                {"bVisible": true, "bSearchable": true, "bSortable": true},
                {"bVisible": true, "bSearchable": false, "bSortable": false},
                {"bVisible": true, "bSearchable": true, "bSortable": true},
                {"bVisible": true, "bSearchable": true, "bSortable": true},
                {"bVisible": true, "bSearchable": true, "bSortable": true},
                {"bVisible": true, "bSearchable": true, "bSortable": true},
                {"bVisible": true, "bSearchable": true, "bSortable": true},
                {"bVisible": true, "bSearchable": false, "bSortable": false}



            ]
        }).columnFilter();
        table.find('tfoot tr th').eq(5).html('');
        table.find('tfoot tr th').eq(11).html('');
    });

    function delete_employee(item_id) {
        if (!confirm("Sure to delete??")) {
            return false;
        }
        url = "employee/delete/" + item_id;
        postData = {"id": item_id}
        $.post(url, postData,
                function (data) {
                    alert('Success');
                    window.location.href = "employee";
                }
        , "text"
                );
    }
</script>
<style type="text/css">
tfoot {
    display: table-header-group;
}
</style>
<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("admin"); ?>">
<?php echo ucfirst($this->uri->segment(1)); ?>
            </a> 
            <span class="divider">/</span>
        </li>
        <li class="active">
<?php echo ucfirst($this->uri->segment(2)); ?>
        </li>
    </ul>

    <div class="page-header users-header">
        <h2>
<?php echo ucfirst($this->uri->segment(2)); ?> 
            <a  href="<?php echo site_url("admin") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-success">Add new Employee</a>
        </h2>
    </div>

    <div class="row">
        <div class="span12 columns">
            <!--          <div class="well">
                       
<?php
//            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
//           
//            $options_department = array(0 => "all");
//            foreach ($department as $row)
//            {
//              $options_department[$row['id']] = $row['name'];
//            }
//            //save the columns names in a array that we will use as filter         
//            $options_employee = array();    
//            foreach ($employee as $array) {
//              foreach ($array as $key => $value) {
//                $options_employee[$key] = $key;
//              }
//              break;
//            }
//
//            echo form_open('admin/employee', $attributes);
//     
//              echo form_label('Search:', 'search_string');
//              echo form_input('search_string', $search_string_selected, 'style="width: 170px;height: 26px;"');
//
//              echo form_label('Filter by department:', 'department_id');
//              echo form_dropdown('department_id', $options_department, $department_selected, 'class="span2"');
//
//              echo form_label('Order by:', 'order');
//              echo form_dropdown('order', $options_employee, $order, 'class="span2"');
//
//              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');
//
//              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
//              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');
//
//              echo form_submit($data_submit);
//
//            echo form_close();
?>
            
                      </div>-->
            <div id="content-table-inner clearfix">

                <div id="table-content">
                    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="employee_list">
                        <thead>
                            <tr>
                                <td>SL</td>
                                <td>ID No.</td>
                                <td>Company</td>
                                <td>Department</td>
                                <td>Name</td>
                                <td>Picture</td>
                                <td>Designation</td>
                                <td>Contact Number</td>
                                <td>Last Increment</td>
                                <td>Increment Amount</td>
                                <td>Is Active?</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>ID No.</th>
                                <th>Company</th>
                                <th>Department</th>
                                <th>Name</th>
                                <th></th>
                                <th>Designation</th>
                                <th>Contact Number</th>
                                <th>Last Increment</th>
                                <th>Increment Amount</th>
                                <th>Is Active?</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!--              <?php
//              foreach($employee as $row)
//              {
//                echo '<tr>';
//                echo '<td>'.$row['id'].'</td>';
//                echo '<td>'.$row['description'].'</td>';
//                echo '<td>'.$row['stock'].'</td>';
//                echo '<td>'.$row['cost_price'].'</td>';
//                echo '<td>'.$row['sell_price'].'</td>';
//                echo '<td>'.$row['department_name'].'</td>';
//                echo '<td class="crud-actions">
//                  <a href="'.site_url("admin").'/employee/update/'.$row['id'].'" class="btn btn-info">view & edit</a>  
//                  <a href="'.site_url("admin").'/employee/delete/'.$row['id'].'" class="btn btn-danger">delete</a>
//                </td>';
//                echo '</tr>';
//              }
?>      -->
                        </tbody>
                    </table>
                </div>
            </div>

<?php //echo '<div class="pagination">'.$this->pagination->create_links().'</div>';   ?>

        </div>
    </div>