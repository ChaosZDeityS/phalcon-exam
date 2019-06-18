{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("masclassgroup/index", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ link_to("masclassgroup/new", "สร้างข้อมูลช่วงชั้น") }}
    </li>
</ul>

{% for masClassGroup in page.items %}
{% if loop.first %}

<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th style="text-align:center">เลขที่ช่วงชั้น</th>
            <th style="text-align:center">ชื่อช่วงชั้นภาษาไทย</th>
            <th style="text-align:center">ชื่อช่วงชั้นภาษาอังกฤษ</th>
            <th style="text-align:center">สถานะข้อมูล</th>
{#            <th style="text-align:center">วันที่มีการเปลี่ยนแปลงล่าสุด</th>#}
        </tr>
    </thead>
{% endif %}

    <tbody>
        <tr>
            <td>{{ masClassGroup.ClassGroupID }}</td>
            <td>{{ masClassGroup.ClassGroupTh }}</td>
            <td>{{ masClassGroup.ClassGroupEn }}</td>
            {% if masClassGroup.RecordStatus === 'N' %}
                <td  style="text-align:center"> ปกติ </td>
            {% else %}
                <td  style="text-align:center"> ลบ </td>
            {% endif  %}
{#            <td>{{ masClassGroup.RecordStatus }}</td>#}
{#            <td>{{ masClassGroup.LastDate }}</td>#}

            <td width="7%">{{ link_to("masclassgroup/edit/" ~ masClassGroup.ClassGroupID, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("masclassgroup/delete/" ~ masClassGroup.ClassGroupID, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("masclassgroup/search", '<i class="icon-fast-backward"></i> First', "class": "btn btn-default") }}
                    {{ link_to("masclassgroup/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn btn-default") }}
                    {{ link_to("masclassgroup/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn btn-default") }}
                    {{ link_to("masclassgroup/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn btn-default") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
    No masclassgroup are recorded
{% endfor %}
