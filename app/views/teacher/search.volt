{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("teacher/index", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ link_to("teacher/new", "สร้างข้อมูลช่วงชั้น") }}
    </li>
</ul>

{% for teacher     in page.items %}



    {% if loop.first %}

<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
{#            <th style="text-align:center">เลขที่ระดับการศึกษา</th>#}
            <th style="text-align:center">รหัสอาจารย์</th>
            <th style="text-align:center">ชื่อ</th>
            <th style="text-align:center">นามสกุล</th>
            <th style="text-align:center">หมายเหตุ</th>

{#            <th style="text-align:center">วันที่มีการเปลี่ยนแปลงล่าสุด</th>#}
        </tr>
    </thead>
{% endif %}

    <tbody>
        <tr>

            <td>{{ teacher.TeacherCode }}</td>
            <td>{{ teacher.FirstName }}</td>
            <td>{{ teacher.LastName }}</td>
            <td>{{ teacher.Note }}</td>


            <td width="7%">{{ link_to("teacher/edit/" ~ teacher.TeacherID, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("teacher/delete/" ~ teacher.TeacherID, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("teacher/search", '<i class="icon-fast-backward"></i> First', "class": "btn btn-default") }}
                    {{ link_to("teacher/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn btn-default") }}
                    {{ link_to("teacher/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn btn-default") }}
                    {{ link_to("teacher/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn btn-default") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
  ไม่พบข้อมูลอาจารย์

{% endfor %}


