import Link from "@components/ui/link";
import React from "react";

interface Props {
  href: string;
  class?: string;
  btnProps: React.ButtonHTMLAttributes<any>;
  isAuthorized: boolean;
}

const AuthMenu: React.FC<Props> = ({
  isAuthorized,
  href,
  class,
  btnProps,
  children,
}) => {
  return isAuthorized ? (
    <Link href={href} class={class}>
      {children}
    </Link>
  ) : (
    <button {...btnProps} />
  );
};

export default AuthMenu;
