{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("schoolstudent/index", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ link_to("schoolstudent/new", "สร้างข้อมูลช่วงชั้น") }}
    </li>
</ul>

{% for schoolStudent     in page.items %}



    {% if loop.first %}

<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
{#            <th style="text-align:center">เลขที่ระดับการศึกษา</th>#}
            <th style="text-align:center">ปีที่เข้าศึกษา</th>
            <th style="text-align:center">รหัสนิสิต</th>
            <th style="text-align:center">หลักสูตร</th>
            <th style="text-align:center">คำนำหน้าชื่อ</th>
            <th style="text-align:center">ชื่อ(Th)</th>
            <th style="text-align:center">นามสกุล(Th)</th>
            <th style="text-align:center">เพศ</th>
{#            <th style="text-align:center">วันเกิด</th>#}
            <th style="text-align:center">หมายเหตุ</th>
{#            <th style="text-align:center">วันที่มีการเปลี่ยนแปลงล่าสุด</th>#}
        </tr>
    </thead>
{% endif %}

    <tbody>
        <tr>

            <td>{{ schoolStudent.AdmitYear }}</td>
            <td>{{ schoolStudent.StudentCode }}</td>
            <td>{{ schoolStudent.getSchoolCourse().CourseNameTh }}</td>
            <td>{{ schoolStudent.getMasPrefixName().PrefixNameTh }}</td>
            <td>{{ schoolStudent.FirstNameTh }}</td>
            <td>{{ schoolStudent.LastNameTh }}</td>
            <td>{{ schoolStudent.getSelective().selectNameTh }}</td>
            <td>{{ schoolStudent.Note }}</td>

            <td width="7%">{{ link_to("schoolstudent/edit/" ~ schoolStudent.StudentID, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("schoolstudent/delete/" ~ schoolStudent.StudentID, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("schoolstudent/search", '<i class="icon-fast-backward"></i> First', "class": "btn btn-default") }}
                    {{ link_to("schoolstudent/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn btn-default") }}
                    {{ link_to("schoolstudent/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn btn-default") }}
                    {{ link_to("schoolstudent/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn btn-default") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
  ไม่พบข้อมูลนักเเรียน

{% endfor %}


