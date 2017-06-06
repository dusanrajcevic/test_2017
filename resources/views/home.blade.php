@extends('layouts.master')

@section('main')

  @if(isset($postcode))
    <h1>{{$postcode->postcode}} - <a href="{{route('details_with_distances', $postcode->id)}}">with distances</a></h1>
    <table>
      <thead>
        <tr>
          <th>{{$num_of_busstops}} closest bus stops</th>
          <th>schools in {{$distance}} km radius</th>
          <th>addresses in that postcode</th>
        </tr>
      </thead>
      <tr>
        <td>
          <ul>
            @foreach($busstops as $busstop)
              <li>{{$busstop->name}}</li>
            @endforeach
          </ul>
        </td>
        <td>
          <ul>
            @foreach($schools as $school)
              <li>{{ $school->name }}</li>
            @endforeach
          </ul>
        </td>
        <td>
          <ul>
          @foreach($postcode->addresses as $address)
            <li>
            {{
              $address->street
            }}{{
              $address->site_number!='' ?
              ', '.$address->site_number :
              ''
            }}{{
              $address->site_description!='' ?
              ', '.$address->site_description :
              ''
            }}
            </li>
          @endforeach
          </ul>
        </td>
      </tr>
    </table>
  @endif
@endsection