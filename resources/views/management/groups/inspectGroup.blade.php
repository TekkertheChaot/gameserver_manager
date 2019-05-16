<?php
$groupID = \App\Group::where('group_name',$groupName) -> get()[0] -> group_id;
$groupMembers = \App\User_Group::where('group_id', $groupID) -> get();
?>


<style>
</style>
<table class="table-width-100">
    @if($groupMembers[0] == null)
    <tr>
        <td class="inspect-td">
            There are no users in this group yet.
        </td>
    </tr>
    @endif
    @foreach($groupMembers as $groupMember)
    <tr>
        <td class="inspect-td">
            {{\App\User::where('user_id', $groupMember -> user_id) -> get()[0] -> username}}
        </td>
    </tr>
    @endforeach
</table>