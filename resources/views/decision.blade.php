<div class="row">
    <div class="col-md-12">
        <br>
        <h3 align="center">Data</h3>
        <br>
        <table class="table table bordered">
            <tr>
                <th>user ID</th>
                <th>email</th>
                <th>date created</th>
                <th>Biodegradable</th>
                <th>recyclable</th>
                <th>residual</th>
                <th>special</th>
                <th>total</th>
            </tr>
            <tr>
                @foreach ($dssData as $row)
                    <tr>
                        <td>{{$row->user_id}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->date_created}}</td>
                        <td>{{$row->biodegradable}}</td>
                        <td>{{$row->recyclable}}</td>
                        <td>{{$row->residual}}</td>
                        <td>{{$row->special}}</td>
                        <td>{{$row->total_waste}}</td>
                    </tr>
                @endforeach
            </tr>
        </table>
    </div>
</div>