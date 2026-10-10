import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable, tap } from 'rxjs';

interface Sesion {
  token: string;
  usuario: string;
  rol: string;
}

interface QuienSoy {
  id: number;
  nombre: string;
  rol: string;
}

@Injectable({
  providedIn: 'root'
})
export class SesionService {
  private readonly storageKey = 'api_token';
  private readonly sesionSubject = new BehaviorSubject<Sesion | null>(null);
  readonly sesion$ = this.sesionSubject.asObservable();

  get token(): string | null {
    return localStorage.getItem(this.storageKey);
  }

  constructor(private http: HttpClient) {
    const token = this.token;
    if (token) {
      this.sesionSubject.next({
        token,
        usuario: 'sesion activa',
        rol: 'desconocido'
      });
    }
  }

  entrar(email: string, password: string): Observable<Sesion> {
    return this.http.post<Sesion>('/api/token', {
      email,
      password,
      dispositivo: 'angular-frontend'
    }).pipe(
      tap((sesion) => {
        localStorage.setItem(this.storageKey, sesion.token);
        this.sesionSubject.next(sesion);
      })
    );
  }

  yo(): Observable<QuienSoy> {
    return this.http.get<QuienSoy>('/api/yo', {
      headers: this.authHeaders()
    });
  }

  salir(): void {
    const token = this.token;
    if (token) {
      this.http.post('/api/token/revocar', {}, {
        headers: this.authHeaders()
      }).subscribe({
        next: () => undefined,
        error: () => undefined
      });
    }

    localStorage.removeItem(this.storageKey);
    this.sesionSubject.next(null);
  }

  private authHeaders(): HttpHeaders {
    const token = this.token ?? '';
    return new HttpHeaders({
      Authorization: `Bearer ${token}`
    });
  }
}
