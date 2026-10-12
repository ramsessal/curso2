import { CanActivateFn, Router } from '@angular/router';
import { inject } from '@angular/core';

import { SesionService } from '../servicios/sesion.service';

export const sesionGuard: CanActivateFn = () => {
  const sesion = inject(SesionService);
  const router = inject(Router);

  return sesion.token ? true : router.parseUrl('/');
};
