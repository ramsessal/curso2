import { Component, OnInit } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http';
import { ActivatedRoute, Router } from '@angular/router';
import { catchError, map, of, switchMap } from 'rxjs';

import { Aviso } from '../modelos/aviso';
import { AvisosService } from '../servicios/avisos.service';
import { SesionService } from '../servicios/sesion.service';

@Component({
  selector: 'app-aviso-detalle',
  templateUrl: './aviso-detalle.component.html',
  styleUrls: ['./aviso-detalle.component.css']
})
export class AvisoDetalleComponent implements OnInit {
  aviso: Aviso | null = null;
  cargando = true;
  error = '';

  constructor(
    private ruta: ActivatedRoute,
    private avisosService: AvisosService,
    private router: Router,
    public sesion: SesionService
  ) { }

  ngOnInit(): void {
    this.ruta.paramMap.pipe(
      map(params => Number(params.get('id'))),
      switchMap(id => {
        this.cargando = true;
        this.error = '';
        this.aviso = null;

        if (!Number.isInteger(id) || id <= 0) {
          this.error = 'Ese aviso no existe.';
          this.cargando = false;
          return of(null);
        }

        return this.avisosService.uno(id).pipe(
          catchError((e: HttpErrorResponse) => {
            this.error = e.status === 404
              ? 'Ese aviso no existe.'
              : `${e.status} · no pude cargar este aviso`;
            this.cargando = false;
            return of(null);
          })
        );
      })
    ).subscribe(aviso => {
      this.aviso = aviso ?? null;
      this.cargando = false;
    });
  }

  cerrar(): void {
    this.router.navigate(['/']);
  }
}
