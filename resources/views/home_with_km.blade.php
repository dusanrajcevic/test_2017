@extends('layouts.master')

@section('main')
  @if(isset($postcode))
    <h1>{{$postcode->postcode}} - <a href="{{route('details', $postcode->id)}}">without distances</a></h1>
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
              <li>{{$busstop->name}} ({{round($busstop->postcode->distance($postcode), 2) }} km)</li>
            @endforeach
          </ul>
        </td>
        <td>
          <ul>
            @foreach($schools as $school)
              <li>{{ $school->name }} ({{round($school->postcode->distance($postcode), 2) }} km)</li>
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