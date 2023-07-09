<select name="localGovtArea" id="localGovtArea" class="form-control js-example-theme-single">
    <option selected disabled>--Select LGA--</option>
    @foreach($lgas as $lga)
        <option value="{{$lga->id}}">{{$lga->local_name ?? '' }}</option>
    @endforeach
</select>

