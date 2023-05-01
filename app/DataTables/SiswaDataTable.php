<?php

namespace App\DataTables;

use App\Models\Siswa;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SiswaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->with('tahunAjaran', 'jurusan')->select('data_siswa.*'))
            ->filter(function ($query) {
            }, true)
            ->editColumn('status_kelulusan', function ($row) {
                if ($row->status_kelulusan === null) {
                    return 'Belum Ditentukan';
                }

                return $row->status_kelulusan ? "Lulus" : "Tidak Lulus";
            })
            ->addColumn('action', function ($row) {
                $action = '<button type="button" class="btn btn-label-primary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>';
                $action .= '<ul class="dropdown-menu" style="">';

                $action .= "<li><a class='dropdown-item action' href='" . url('data-siswa/' . $row->id . '/edit') . "'>Edit</a></li>";
                $action .= "<li><a class='dropdown-item action' href='" . url('data-siswa/kelulusan/' . $row->id) . "'>Status Kelulusan</a></li>";

                return $action .= '</ul>';
            })
            ->addIndexColumn()
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SiswaDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Siswa $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('siswa-table')
            ->parameters(['searchDelay' => 1000, 'responsive' => ['details' => ['display' => '$.fn.dataTable.Responsive.display.childRowImmediate']]])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('No')->width(20)->orderable(false)->searchable(false),
            Column::make('nis'),
            Column::make('nisn'),
            Column::make('nama_siswa'),
            Column::make('jenis_kelamin'),
            Column::make('tahun_ajaran.tahun_ajaran')->name('tahun_ajaran.tahun_ajaran')->title('Tahun Ajaran'),
            Column::make('jurusan.nama_jurusan')->name('jurusan.nama_jurusan')->title('Jurusan'),
            Column::make('status_kelulusan'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Siswa_' . date('YmdHis');
    }
}
