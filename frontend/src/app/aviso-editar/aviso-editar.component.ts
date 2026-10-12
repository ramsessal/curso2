import { Component, OnInit } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';

import { Aviso, NuevoAviso } from '../modelos/aviso';
import { AvisosService } from '../servicios/avisos.service';

@Component({
  selector: 'app-aviso-editar',
  templateUrl: './aviso-editar.component.html',
  styleUrls: ['./aviso-editar.component.css']
})
export class AvisoEditarComponent implements OnInit {
  id = 0;
  form: FormGroup;
  mensaje = '';
  enviando = false;
  cargando = true;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private avisosService: AvisosService,
    private fb: FormBuilder
  ) {
    this.form = this.fb.group({
      titulo: ['', [Validators.required, Validators.maxLength(120)]],
      contenido: ['', Validators.required],
      categoria_id: [null, Validators.required]
    });
  }

  ngOnInit(): void {
    this.id = Number(this.route.snapshot.paramMap.get('id'));

    this.avisosService.uno(this.id).subscribe({
      next: (aviso: Aviso) => {
        this.form.setValue({
          titulo: aviso.titulo,
          contenido: aviso.contenido,
          categoria_id: aviso.categoria?.id ?? null
        });
        this.cargando = false;
      },
      error: (e: HttpErrorResponse) => {
        this.mensaje = e.status === 404
          ? 'Ese aviso no existe.'
          : `${e.status} · no pude cargar este aviso`;
        this.cargando = false;
      }
    });
  }

  guardar(): void {
    if (this.form.invalid) {
      this.form.markAllAsTouched();
      return;
    }

    const aviso: NuevoAviso = this.form.value;
    this.enviando = true;
    this.mensaje = '';

    this.avisosService.actualizar(this.id, aviso).subscribe({
      next: () => {
        this.enviando = false;
        this.router.navigate(['/avisos', this.id]);
      },
      error: (e: HttpErrorResponse) => {
        this.enviando = false;
        this.mensaje = e.status === 403
          ? '403 · ese aviso no es tuyo. Lo decidió tu PostPolicy, no el guard.'
          : `${e.status} · tu API no lo actualizó`;
      }
    });
  }
}
