<?php
$groups = \App\Group::all();
$users_groups = \App\User_Group::all();
?>


<style>

</style>
<div class="card floating-card">
    <div class="card-header">All groups</div>
    <div class="card-body no-padding">
        <table class="table-width-100">
            @foreach($groups as $group)
            <tr>
                <td class="group-td" onClick="onClickInspectGroup(event)">{{$group->group_name}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card floating-card">
    <div id="group-inspect-modal" class="modal">
        <!-- Modal content -->
        <div class="modal-c">
            <div class="ld ld-spin-fast ld-spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div class="card-header">Members</div>
    <div id="group-inspect-body" class="card-body no-padding">
      <div class="card-body">Select a Group to inspect</div>
    </div>