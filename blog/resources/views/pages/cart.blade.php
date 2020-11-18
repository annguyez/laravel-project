@extends('layout.index')
@section('content')
<table>
   	<thead>
       	<tr>
               <th>Product</th>
               <th>Image</th>
           	<th>Qty</th>
           	<th>Price</th>
           	<th>Delete</th>
       	</tr>
   	</thead>

   	<tbody>

   		
@foreach($item as $i)
       		<tr>
           		<td>
               		{{$i->name}}
           		</td>
                <td><img src="upload/tintuc/{{$i->options->img}}"></td>
                <td>{{$i->qty}}</td>
                <td>
                {{$i->price}}
           		</td>
                   <td><a href="cart/delete/{{$i->rowId}}">x</a></td>
                   
           		
       		</tr>

@endforeach
       </tbody>
       <a href="cart/delete/all">Xoa het sach gio hang</a>
   	<tfoot>
   		<tr>
   			<td colspan="2">&nbsp;</td>
   			<td>Subtotal</td>
   			<td><?php echo Cart::subtotal(); ?></td>
   		</tr>
   		<tr>
   			<td colspan="2">&nbsp;</td>
   			<td>Tax</td>
   			<td><?php echo Cart::tax(); ?></td>
   		</tr>
   		<tr>
   			<td colspan="2">&nbsp;</td>
   			<td>Total</td>
   			<td><?php echo Cart::total(); ?></td>
   		</tr>
   	</tfoot>
   
</table>
@endsection