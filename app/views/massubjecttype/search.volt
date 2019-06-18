{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("massubjecttype/index", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ link_to("massubjecttype/new", "เพิ่มข้อมูลประเภทรายวิชา") }}
    </li>
</ul>

{% for masSubjectType in page.items %}
{% if loop.first %}

<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>

{#            <th style="text-align:center">ลำดับ</th>#}
            <th style="text-align:center">ชื่อประเภทรายวิชา(Th)</th>
            <th style="text-align:center">ชื่อประเภทรายวิชา(En)</th>
            <th style="text-align:center">รายละเอียด</th>
            <th style="text-align:center">วันที่เปลี่ยนแปลงล่าสุด</th>

            {#            <th style="text-align:center">วันที่มีการเปลี่ยนแปลงล่าสุด</th>#}
        </tr>
    </thead>
{% endif %}

    <tbody>
        <tr>
{#            <td style="text-align:center" width="5%">{{ masPrefixName.PrefixNameID }}</td>#}
            <td>{{ masSubjectType.SubjectTypeNameTh }}</td>
            <td>{{ masSubjectType.SubjectTypeNameEn }}</td>
            <td>{{ masSubjectType.SubjectTypeDetail }}</td>
            <td>{{ masSubjectType.LastDate }}</td>



            {#            {% if masClassGroup.RecordStatus === 'N' %}#}
{#                <td  style="text-align:center"> ปกติ </td>#}
{#            {% else %}#}
{#                <td  style="text-align:center"> ลบ </td>#}
{#            {% endif  %}#}


            <td width="7%">{{ link_to("massubjecttype/edit/" ~ masSubjectType.SubjectTypeID, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("massubjecttype/delete/" ~ masSubjectType.SubjectTypeID, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("massubjecttype/search", '<i class="icon-fast-backward"></i> First', "class": "btn btn-default") }}
                    {{ link_to("massubjecttype/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn btn-default") }}
                    {{ link_to("massubjecttype/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn btn-default") }}
                    {{ link_to("massubjecttype/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn btn-default") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
    ไม่พบข้อมูล
{% endfor %}
