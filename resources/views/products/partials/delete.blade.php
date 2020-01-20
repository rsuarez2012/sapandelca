<form action="{{route('eliminar_producto', $product->id)}}" method="POST">
    {{csrf_field()}}
    <button type="submit" class="btn btn-round btn-danger btn-sm" onclick="return confirm('Seguro desea eliminar?')"><i class="fa fa-trash-o"></i>&nbsp;</button>
                    </form>