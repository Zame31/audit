<li class="{{ Request::is('admin/audit/reffActivities*') ? 'active' : '' }}">
    <a href="{!! route('admin.audit.reffActivities.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="list" data-size="18"
               data-loop="true"></i>
               Reff Activity
    </a>
</li>
<li class="{{ Request::is('admin/audit/reffClassAudits*') ? 'active' : '' }}">
    <a href="{!! route('admin.audit.reffClassAudits.index') !!}">
    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="list" data-size="18"
               data-loop="true"></i>
               Reff Class Audits
    </a>
</li>
