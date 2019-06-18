{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("masprefixname/index", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ link_to("masprefixname/new", "เพิ่มข้อมูลคำนำหน้าชื่อ") }}
    </li>
</ul>

{% for masPrefixName in page.items %}
{% if loop.first %}

<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>

{#            <th style="text-align:center">ลำดับ</th>#}
            <th style="text-align:center">คำนำหน้าชื่อ(Th)</th>
{#            <th style="text-align:center">คำนำหน้าชื่อ(En)</th>#}
            <th style="text-align:center">คำนำหน้าชื่อแบบย่อ(Th)</th>
            <th style="text-align:center">วันที่เปลี่ยนแปลงล่าสุด)</th>

            {#            <th style="text-align:center">วันที่มีการเปลี่ยนแปลงล่าสุด</th>#}
        </tr>
    </thead>
{% endif %}

    <tbody>
        <tr>
{#            <td style="text-align:center" width="5%">{{ masPrefixName.PrefixNameID }}</td>#}
            <td>{{ masPrefixName.PrefixNameTh }}</td>
            <td>{{ masPrefixName.PrefixNameEn }}</td>
{#            <td>{{ masPrefixName.InitialsTh }}</td>#}
            <td>{{ masPrefixName.LastDate }}</td>



            {#            {% if masClassGroup.RecordStatus === 'N' %}#}
{#                <td  style="text-align:center"> ปกติ </td>#}
{#            {% else %}#}
{#                <td  style="text-align:center"> ลบ </td>#}
{#            {% endif  %}#}


            <td width="7%">{{ link_to("masprefixname/edit/" ~ masPrefixName.PrefixNameID, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("masprefixname/delete/" ~ masPrefixName.PrefixNameID, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("masprefixname/search", '<i class="icon-fast-backward"></i> First', "class": "btn btn-default") }}
                    {{ link_to("masprefixname/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn btn-default") }}
                    {{ link_to("masprefixname/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn btn-default") }}
                    {{ link_to("masprefixname/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn btn-default") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
    ไม่พบข้อมูลคำนำหน้าชื่อ
{% endfor %}
